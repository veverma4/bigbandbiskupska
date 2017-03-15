<?php

namespace App\Model;

use Tulinkry\Poll\Services\NeonPollProvider;

class UpdateModel
{
    /**
     * @var SongModel
     */
    private $songs;
    /**
     * @var NeonPollProvider
     */
    private $polls;

    public function __construct (SongModel $songs, NeonPollProvider $polls) {
        $this->songs = $songs;
        $this->polls = $polls;
    }

    public function __invoke () {
        $poll = null;
        foreach($this->polls->all() as $p) {
            if($p->question->text === 'Anketa o divácky nejoblíbenější píseň') {
                $poll = $p;
            }
        }

        if(!$poll) {
            $poll = $this->polls->create('Anketa o divácky nejoblíbenější píseň');
        }

        $songs = $this->songs->by( [ ], [ "name" => "ASC" ] );
        $answers = $this->polls->getAnswers($poll->id);
        if(count($answers) !== count($songs)) {
            foreach($songs as $song) {
                $skip = false;
                foreach($answers as $answer) {
                    if($answer->getText() === $song->name) {
                        $skip = true;
                        break;
                    }
                }
                if($skip) {
                    continue;
                }
                $this->polls->addAnswer($poll->id, $song->name);
            }
        }
    }
};
