<?php

namespace Company\Split\Controller\Rest\Resource;

use Company\Split\Domain\Person\Person;
use Company\Split\Domain\Person\PersonDataPicker;

class ProfileMaker implements PersonDataPicker
{
    /** @var ProfileResource  */
    private $profile;

    public function makeFromPerson(Person $source): ProfileResource
    {
        $this->profile = new ProfileResource();
        $source->dumpData($this);
        $result = $this->profile;
        $this->profile = null;

        return $result;
    }

    public function setId(string $id)
    {
        $this->profile->id = $id;
    }

    public function setName(string $name)
    {
        $this->profile->fullName = $name;
    }

    public function setEmail(string $email)
    {
        $this->profile->emailAddress = $email;
    }
}
