<?php

if (! function_exists('convert_quote_full_to_half_width')) {
    /**
     * @param string $value
     * @return string
     */
    function convert_quote_full_to_half_width(string $value): string
    {
        return str_replace(['＂', '”', '＇', '’'], ['"', '"', "'", "'"], $value);
    }
}

if (! function_exists('split_string_with_regex')) {
    /**
     * @param string $subject
     * @param string $regex
     * @return array<string>
     */
    function split_string_with_regex(string $subject, string $regex = '/([\s　]+)/u'): array
    {
        return preg_split($regex, mb_trim($subject));
    }
}

if (! function_exists('mb_trim')) {
    /**
     * @param string $subject
     * @param string $chars
     * @return string
     */
    function mb_trim(string $subject, string $chars = '\s　'): string
    {
        $subject = preg_replace("/^[$chars]+/u", '', $subject);
        return preg_replace("/[$chars]+$/u", '', $subject);
    }
}

if (!function_exists('authCompId')) {
    function authCompId(): ?int
    {
        return optional(auth()->user())->getCompanyId();
    }
}

if (!function_exists('authStaff')) {
    function authStaff(): ?int
    {
        return optional(auth()->user())->getAccountNo();
    }
}

if (!function_exists('authMasterFlg')) {
    function authMasterFlg(): ?int
    {
        return optional(auth()->user())->getMasterFlg();
    }
}

if (!function_exists('allowSendMailToUserOrCompany')) {
    function allowSendMailToUserOrCompany(): bool
    {
        return config('mail.scope') !== MailScope::ADMIN && config('mail.scope') !== MailScope::DISABLED;
    }
}

if (!function_exists('milliseconds')) {
    function milliseconds(): int
    {
        return (int) round(microtime(true) * 1000);
    }
}

if (!function_exists('mSleep')) {
    function mSleep(int $milliseconds): void
    {
        usleep($milliseconds * 1000);
    }
}

if (!function_exists('arrayToRegex')) {
    function arrayToRegex(array $keyWords, bool $caseSensitive = true): string
    {
        if (empty($keyWords)) {
            return '';
        }

        $regex = '';

        foreach ($keyWords as $keyWord) {
            $regex .= preg_quote($keyWord, "/") . '|';
        }

        $regex = rtrim($regex, '|');
        return $caseSensitive ? "/$regex/" : "/$regex/i";
    }
}
