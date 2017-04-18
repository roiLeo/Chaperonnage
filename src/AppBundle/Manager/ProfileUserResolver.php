<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 18/04/2017
 * Time: 11:47
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Picture;
use AppBundle\Entity\User;

class ProfileUserResolver
{


//    VERIFICATION


    public function resolvePhone(User $user){
        $phone = $user->getPhoneVerified();
        if($phone === true){
            return true;
        }else{
            return false;
        }
    }

    public function resolvePictureVerified(User $user){
        $picture = $user->getPicture();
        if($picture != null){
            $pictureVerified = $picture->getVerified();
            if($pictureVerified != null && $pictureVerified === true){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function resolveCredentialVerified(User $user){
        $credential = $user->getCredential();
        if($credential != null){
            $credentialVerified = $credential->getVerified();
            if($credentialVerified != null && $credentialVerified === true){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


//    INFORMATIONS

    public function resolveNiveau(User $user){

        $rideJoin = $user->getRideJoined()->count();
        $rideCreated = $user->getRideCreated()->count();
        $allride = $rideCreated + $rideJoin;
        if($allride < 10){
            return "Débutant";
        }else if($allride < 20){
            return "Habitué";
        }else if($allride < 30){
            return "Confirmé";
        }else if($allride > 30){
            return "Expert";
        }else{
            return "Erreur";
        }
    }

    public function resolveNombreCopieto(User $user){
        $rideJoin = $user->getRideJoined()->count();
        $rideCreated = $user->getRideCreated()->count();
        $allride = $rideCreated + $rideJoin;
        return $allride;
    }


}