<?php

namespace App\Http\Controllers;
use Webklex\PHPIMAP\ClientManager;
//use Webklex\PHPIMAP\Client;
use Webklex\IMAP\Facades\Client;

use Illuminate\Http\Request;
use Session;
use Mail;

class EmailFetchController extends Controller
{


     public function welcome(){
        return View('welcome');
    }
    // public function connect(Request $request){

    //     $cm = new ClientManager();
    //     $client = $cm->make([
    //         'host'          => 'mail.equatorial-property.com',
    //         'port'          => 993,
    //         'encryption'    => 'ssl',
    //         'validate_cert' => true,
    //         'protocol'      => 'imap',
    //         'username'      => $request->email,
    //         'password'      => $request->password
    //      ]);
    //      $client->connect();

    //      return redirect()->route('indexPage',['client'=>$client]);
    // }


    // public function index()
    // {
    //     return view('emails');
    // }
    public function definition(Request $request)
    {



       // $oClient = Client::account('gmail');
       $oClient = Client::account('default');
       // print_r($oClient); exit;

        $oClient->connect();
       // print_r($oClient); exit;


        //Get all Mailboxes
        /** @var \Webklex\IMAP\Support\FolderCollection $aFolder */
        $aFolder = $oClient->getFolders();
        //var_dump($aFolder);die;
        //$oFolder = $oClient->getFolder('INBOX.name');

        foreach($aFolder as $oFolder){

               //Get all messages from example@domain.com
                /** @var \Webklex\IMAP\Support\MessageCollection $aMessage */
               // $aMessage = $oFolder->query()->from('shubhangishubh1996@gmail.com')->get();
                $aMessage = $oFolder->query()->since('15.03.2018')->limit(10, 2)->get();

               // print_r($aMessage); exit;

            /** @var \Webklex\IMAP\Message $oMessage */
            foreach($aMessage as $oMessage){

                echo $oMessage->getSubject().'<br />';
                echo 'Attachments: '.$oMessage->getAttachments()->count().'<br />';
                echo $oMessage->getHTMLBody(true);

                //Move the current Message to 'INBOX.read'
                // if($oMessage->moveToFolder('INBOX.read') == true){
                //     echo 'Message has ben moved';
                // }else{
                //     echo 'Message could not be moved';
                // }
            }
        }


        return view('emails')->with($oMessage);


    }

}
