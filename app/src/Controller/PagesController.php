<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Calendar;
use App\Model\Entity\Configuraco;
use Google_Service_Exception;
use Google_Auth_Exception;
use Google_Service_Calendar_Event;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->set('title', 'Calendário');
    }

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function home() {
        
    }

    public function calendario() {
        
    }

    public function calendarioGoogle($ajax = false) {
        $this->viewBuilder()->layout(false);
        try {
            // Get the API client and construct the service object.
            $client = $this->getClient();
            if (!empty($client)) {
                $calendarId = $this->obterCalendario($client);
                $dataMin = isset($this->request->data['minDate']) ? new \DateTime($this->request->data['minDate']) : new \DateTime(date('Y-m-01'));
                $dataMax = new \DateTime($dataMin->format('Y') . '-' . $dataMin->format('m') . '-' . $dataMin->format('t'));
                $optParams = array(
                    'timeMin' => $dataMin->format('c'),
                    'timeMax' => $dataMax->format('c')
                );
                $service = new Google_Service_Calendar($client);
                $eventos = $service->events->listEvents($calendarId, $optParams);
                $this->set(compact('eventos'));
                if ($ajax) {
                    $this->set('_serialize', false);
                    $this->render('eventos_json', 'ajax');
                }
            }
        } catch (Google_Service_Exception $e) {
            $this->set('calendario_error', $e->getMessage());
            $this->render('calendario-error');
        } catch (Google_Auth_Exception $e) {
            $this->set('calendario_error', $e->getMessage());
            $this->render('calendario-error');
        }
    }

    public function registrarEvento() {

        $retorno = array('sucesso' => true);
        try {
            // Get the API client and construct the service object.
            $client = $this->getClient();
            if (!empty($client)) {
                $dtInicio = new \DateTime($this->request->data['dtEvento'] . ' 00:00:00');
                $dtFim = new \DateTime($this->request->data['dtEvento'] . ' 23:59:59');
                $event = new Google_Service_Calendar_Event(array(
                    'summary' => $this->request->data['nmEvento'],
                    'description' => '-',
                    'start' => array(
                        'dateTime' => $dtInicio->format('c'),
                        'timeZone' => 'America/Bahia',
                    ),
                    'end' => array(
                        'dateTime' => $dtFim->format('c'),
                        'timeZone' => 'America/Bahia',
                    ),
                    'reminders' => array(
                        'useDefault' => FALSE,
                        'overrides' => array(
                            array('method' => 'email', 'minutes' => 24 * 60),
                            array('method' => 'popup', 'minutes' => 10),
                        ),
                    ),
                ));

                $calendarId = $this->obterCalendario($client);
                $service = new Google_Service_Calendar($client);
                $event = $service->events->insert($calendarId, $event);
            }
        } catch (Google_Service_Exception $e) {
            $retorno['sucesso'] = false;
            $retorno['msg'] = $e->getMessage();
        } catch (Google_Auth_Exception $e) {
            $retorno['sucesso'] = false;
            $retorno['msg'] = $e->getMessage();
        }

        $this->viewBuilder()->layout(false);
        $this->set(compact('retorno'));
        $this->set('_serialize', ['retorno']);
    }

    public function obterCalendario($client) {
        $this->loadModel('Configuracoes');
        $configuracoes = $this->Configuracoes->find('all')->toArray();
        $calendarioId = $configuracoes[0]->google_agenda_id;
        if (empty($calendarioId)) {
            $calendar = new Google_Service_Calendar_Calendar();
            $calendar->setSummary('Agenda Financeira');
            $calendar->setTimeZone('America/Bahia');
            $service = new Google_Service_Calendar($client);
            $retorno = $service->calendars->insert($calendar);
            $calendarioId = $retorno->getId();

            $config = $this->Configuracoes->get(1, [
                'contain' => []
            ]);
            $patch = $this->Configuracoes->patchEntity($config, [
                'google_agenda_id' => $calendarioId
            ]);
            $this->Configuracoes->save($patch);
        }

        return $calendarioId;
    }

    /**
     * Na conceção do acesso será armazenado na base de dados o refresh token
     * @param type $token
     */
    public function atualizarRefreshToken($token) {
        $dadosToken = json_decode($token);
        if (isset($dadosToken->refresh_token)) {
            $refreshToken = $dadosToken->refresh_token;
            $this->loadModel('Configuracoes');
            $config = $this->Configuracoes->get(1, [
                'contain' => []
            ]);
            $patch = $this->Configuracoes->patchEntity($config, [
                'refresh_token_google_api' => $refreshToken
            ]);
            $this->Configuracoes->save($patch);
        }
    }

    public function obterRefreshToken() {
        $this->loadModel('Configuracoes');
        $config = $this->Configuracoes->get(1, [
            'contain' => []
        ]);
        return $config->refresh_token_google_api;
    }

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    function getClient() {
        $this->obterRefreshToken();
        $client = new Google_Client();
        $client->setApplicationName(GOOGLE_APPLICATION_NAME);
        $client->setScopes(GOOGLE_SCHEDULE_SCOPES);
        $client->setAuthConfigFile(GOOGLE_CLIENT_SECRET_PATH);
        $client->setAccessType('offline');
        $client->setRedirectUri('http://localhost/meudinheiro/app/pages/calendario');
        // Load previously authorized credentials from a file.
        $credentialsPath = $this->expandHomeDirectory(GOOGLE_CREDENTIALS_PATH);
        if (file_exists($credentialsPath)) {
            $accessToken = file_get_contents($credentialsPath);
        } else {

            $authCode = isset($this->request->query['code']) ?
                    trim($this->request->query['code']) : null;
            if (empty($authCode)) {

                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                $this->redirect($authUrl);
            } else {
                // Exchange authorization code for an access token.
                $accessToken = $client->authenticate($authCode);
                $this->atualizarRefreshToken($accessToken);

                // Store the credentials to disk.
                if (!file_exists(dirname($credentialsPath))) {
                    mkdir(dirname($credentialsPath), 0700, true);
                }
                file_put_contents($credentialsPath, $accessToken);
            }
        }
        if (!empty($accessToken)) {
            $client->setAccessToken($accessToken);
            // Refresh the token if it's expired.    
            if ($client->isAccessTokenExpired()) {
                $client->refreshToken($this->obterRefreshToken());
                file_put_contents($credentialsPath, $client->getAccessToken());
            }
            return $client;
        }
    }

    /**
     * Expands the home directory alias '~' to the full path.
     * @param string $path the path to expand.
     * @return string the expanded path.
     */
    function expandHomeDirectory($path) {
        $homeDirectory = getenv('HOME');
        if (empty($homeDirectory)) {
            $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
        }
        return str_replace('~', realpath($homeDirectory), $path);
    }

    function renovarAcessoGoogleApi() {
        $retorno = array('sucesso' => true);
        if (file_exists(GOOGLE_CREDENTIALS_PATH)) {
            if (!unlink(GOOGLE_CREDENTIALS_PATH)) {
                $retorno['sucesso'] = false;
                $retorno['msg'] = 'Erro ao excluir as credenciais';
            }
        }
        $this->viewBuilder()->layout(false);
        $this->render(false);
        echo json_encode($retorno);
    }

}
