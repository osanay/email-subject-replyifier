Email Subject Replyifier
========================

Convert an email subject line into reply style, inspired by Perl’s [Mail::Message::Construct::Reply](http://search.cpan.org/dist/Mail-Box/lib/Mail/Message/Construct/Reply.pod).

Usage
-----

The `replyify()` method creates a subject for a message which is a reply to this one:

```php
<?php

use Osanay\EmailSubjectReplyifier\Replyifier;

$subject = Replyifier::replyify('subject');                 // Re: subject
$subject = Replyifier::replyify('Re: subject');             // Re: subject
$subject = Replyifier::replyify('Re[2]: subject');          // Re: subject
$subject = Replyifier::replyify('Re: Re: Re: Re: subject'); // Re: subject
```

### Adding **Re:** count

If you need a **Re:** count in an email subject line, you can pass `true` as the second argument:

```php
$subject = Replyifier::replyify('subject', true);                 // Re: subject
$subject = Replyifier::replyify('Re: subject', true);             // Re[2]: subject
$subject = Replyifier::replyify('Re[2]: subject', true);          // Re[3]: subject
$subject = Replyifier::replyify('Re: Re: Re: Re: subject', true); // Re[5]: subject
```

This routine tries to count the level of reply in the subject field, and transform it into a standard form.
