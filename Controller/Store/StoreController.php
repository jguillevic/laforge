<?php

namespace Controller\Store;

use \Framework\View\View;
use \Tools\Helper\UserHelper;
use \Model\Store\Store;
use \Model\Store\Contact\Contact;
use \Model\Store\Social\Social;
use \Model\Store\Address\Address;
use \Model\Store\Schedule\Schedule;
use \Model\Store\Schedule\DaySchedule;
use \Model\Store\Schedule\DayScheduleSection;
use \BLL\Store\StoreBLL;
use \Framework\Tools\Helper\PathHelper;
use \Framework\Tools\Helper\RoutesHelper;

/**
 * @author JGuillevic
 */
class StoreController
{
    public function Update($queryParameters)
    {
        if (UserHelper::CanManageStore())
		{
            $storeBLL = new StoreBLL();
            $path = PathHelper::GetPath([ "Store", "ManageStore" ]);
            $view = new View($path);

			if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                $store = new Store();
                self::MapStore($store, $queryParameters);

                $storeBLL->Update([ $store->GetId() => $store ]);
            }

            $stores = $storeBLL->LoadAll();
            $store = array_pop($stores);

            return $view->Render(["store" => $store]);
        }

        RoutesHelper::Redirect("DisplayHome");
    }

    private static function MapStore($store, $queryParameters)
    {
        $contact = new Contact();
        self::MapContact($contact, $queryParameters);
        $store->SetContact($contact);

        $address = new Address();
        self::MapAddress($address, $queryParameters);
        $store->SetAddress($address);

        $social = new Social();
        self::MapSocial($social, $queryParameters);
        $store->SetSocial($social);

        $schedule = new Schedule();
        self::MapSchedule($schedule, $queryParameters);
        $store->SetSchedule($schedule);
    }

    private static function MapContact($contact, $queryParameters)
    {
        $contact->SetId($queryParameters["store-contact-id"]->GetValue());
        $contact->SetEmail($queryParameters["store-contact-email"]->GetValue());
        $contact->SetPhoneNumber($queryParameters["store-contact-phonenumber"]->GetValue());
        $contact->SetMessenger($queryParameters["store-contact-messenger"]->GetValue());
    }

    private static function MapAddress($address, $queryParameters)
    {
        $address->SetId($queryParameters["store-address-id"]->GetValue());
        $address->SetSocialReason($queryParameters["store-address-socialreason"]->GetValue());
        $address->SetLine1($queryParameters["store-address-line1"]->GetValue());
        $address->SetLine2($queryParameters["store-address-line2"]->GetValue());
        $address->SetLine3($queryParameters["store-address-line3"]->GetValue());
        $address->SetPostalCode($queryParameters["store-address-postalcode"]->GetValue());
        $address->SetCity($queryParameters["store-address-city"]->GetValue());
    }

    private static function MapSocial($social, $queryParameters)
    {
        $social->SetId($queryParameters["store-social-id"]->GetValue());
        $social->SetFacebookLink($queryParameters["store-social-facebooklink"]->GetValue());
        $social->SetTwitterLink($queryParameters["store-social-twitterlink"]->GetValue());
        $social->SetYoutubeLink($queryParameters["store-social-youtubelink"]->GetValue());
        $social->SetInstagramLink($queryParameters["store-social-instagramlink"]->GetValue());
    }

    private static function MapSchedule($schedule, $queryParameters)
    {
        $scheduleId = $queryParameters["store-schedule-id"]->GetValue();
        $schedule->SetId($scheduleId);

        foreach ($queryParameters as $key => $queryParameter)
        {
            if (strlen($key) > 26 && substr($key, 0, 26) == "store-schedule-dayschedule")
            {
                $explodeResult = explode("-", $key);

                if (count($explodeResult) == 5)
                {
                    $dayScheduleId = intval(explode(":", $explodeResult[3])[1]);
                    $dayId = intval(explode(":", $explodeResult[4])[1]);

                    if (!array_key_exists($dayScheduleId, $schedule->GetDaySchedules()))
                    {
                        $daySchedule = new DaySchedule();
                        $daySchedule->SetId($dayScheduleId);
                        $daySchedule->GetDay()->SetId($dayId);
                        $schedule->AddDaySchedule($dayScheduleId, $daySchedule); 
                    }
                }
                else
                {
                    $dayScheduleId = intval(explode(":", $explodeResult[3])[1]);
                    $dayId = intval(explode(":", $explodeResult[4])[1]);
                    $sectionId = intval(explode(":", $explodeResult[6])[1]);
                    $time = $explodeResult[7];

                    if (!array_key_exists($dayScheduleId, $schedule->GetDaySchedules()))
                    {
                        $daySchedule = new DaySchedule();
                        $daySchedule->SetId($dayScheduleId);
                        $daySchedule->GetDay()->SetId($dayId);
                        $daySchedule->SetScheduleId($scheduleId);
                        $schedule->AddDaySchedule($dayScheduleId, $daySchedule); 
                    }
                    
                    $daySchedule = $schedule->GetDaySchedules()[$dayScheduleId];

                    if (!array_key_exists($sectionId, $daySchedule->GetSections()))
                    {
                        $section = new DayScheduleSection();
                        $section->SetDayScheduleId($dayScheduleId);
                        $daySchedule->AddSection($sectionId, $section);  
                    }

                    $section = $daySchedule->GetSections()[$sectionId];

                    if ($time == "startingtime")
                        $section->SetStartingTime(new \DateTime($queryParameter->GetValue()));
                    else if ($time == "endingtime")
                        $section->SetEndingTime(new \DateTime($queryParameter->GetValue()));
                }
            }
        }
    }
}