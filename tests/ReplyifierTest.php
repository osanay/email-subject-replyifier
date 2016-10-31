<?php

namespace Osanay\EmailSubjectReplyifier\tests;

use PHPUnit\Framework\TestCase;
use Osanay\EmailSubjectReplyifier\Replyifier;

class ReplyifierTest extends TestCase
{
    public function testReplyify()
    {
        $this->assertEquals('Re: subject', Replyifier::replyify('subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('RE: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re[1]: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re[2]: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('RE[2]: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re: Re: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('RE: RE: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re: Re[2]: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re Re: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re,Re: subject'));
        $this->assertEquals('Re: subject', Replyifier::replyify('Re Re[2]: subject'));
        $this->assertEquals('Re: subject: sub2', Replyifier::replyify('subject: sub2'));
        $this->assertEquals('Re: subject: sub2', Replyifier::replyify('Re: subject: sub2'));
        $this->assertEquals('Re: subject : sub2', Replyifier::replyify('subject : sub2'));
    }

    public function testReplyifyWithAddingReCount()
    {
        $this->assertEquals('Re: subject', Replyifier::replyify('subject', true));
        $this->assertEquals('Re[2]: subject', Replyifier::replyify('Re: subject', true));
        $this->assertEquals('Re[2]: subject', Replyifier::replyify('RE: subject', true));
        $this->assertEquals('Re[2]: subject', Replyifier::replyify('Re[1]: subject', true));
        $this->assertEquals('Re[3]: subject', Replyifier::replyify('Re[2]: subject', true));
        $this->assertEquals('Re[3]: subject', Replyifier::replyify('RE[2]: subject', true));
        $this->assertEquals('Re[3]: subject', Replyifier::replyify('Re: Re: subject', true));
        $this->assertEquals('Re[3]: subject', Replyifier::replyify('RE: RE: subject', true));
        $this->assertEquals('Re[4]: subject', Replyifier::replyify('Re: Re[2]: subject', true));
        $this->assertEquals('Re[3]: subject', Replyifier::replyify('Re Re: subject', true));
        $this->assertEquals('Re[3]: subject', Replyifier::replyify('Re,Re: subject', true));
        $this->assertEquals('Re[4]: subject', Replyifier::replyify('Re Re[2]: subject', true));
        $this->assertEquals('Re: subject: sub2', Replyifier::replyify('subject: sub2', true));
        $this->assertEquals('Re[2]: subject: sub2', Replyifier::replyify('Re: subject: sub2', true));
        $this->assertEquals('Re: subject : sub2', Replyifier::replyify('subject : sub2', true));
    }
}
