<?php

namespace App\Traits\Auth;

trait MustVerifyPhone
{
    /**
     * Determine if the user has verified their phone.
     *
     * @return bool
     */
    public function hasVerifiedPhone()
    {
        return null !== $this->phone_verified_at;
    }

    /**
     * Mark the given user's phone as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the phone verification notification.
     *
     * @return void
     */
    public function sendPhoneVerificationNotification()
    {
        //need to implement logic
    }
}
