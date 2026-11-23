<?php

namespace JawadAhmed\SocialAuth;

interface SocialUserLinker
{
    public function link(string $provider, object $socialUser): object;
}
