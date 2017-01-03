<?php

namespace Osanay\EmailSubjectReplyifier;

class Replyifier
{
    /**
     * @param string $subject
     * @param bool   $isReCountRequired
     *
     * @return string
     */
    public static function replyify(string $subject, bool $isReCountRequired = false): string
    {
        $subjects = explode(':', $subject);
        $reCount = 1;

        // Strip multiple Re's.
        while (count($subjects)) {
            if (preg_match('/[A-QS-Za-qs-z][A-DF-Za-df-z]/', $subjects[0])) {
                break;
            }

            preg_match_all('/\bR[Ee](?:\[\s*(?P<digit>\d+)\s*\]|\b)/', $subjects[0], $matches);
            foreach ($matches['digit'] as $digit) {
                $reCount += !empty($digit) ? (int) $digit : 1;
            }
            array_shift($subjects);
        }

        // Create the new subject string.
        $text = implode(':', $subjects);
        $text = trim($text);

        if ($isReCountRequired) {
            return 1 === $reCount ? "Re: $text" : "Re[$reCount]: $text";
        }

        return 'Re: '.$text;
    }
}
