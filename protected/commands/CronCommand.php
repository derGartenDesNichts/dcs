<?php
/**
 * Class for management Seo crons.
 */
class CronCommand extends CConsoleCommand
{
    /**
     * Perform centralized direction over crons execution and adjust seo data updating.
     */
    public function actionCheckVotes()
    {
        $answers = Answers::model()->getExpiredAnswers();
        //die(var_dump($answers->search()));
    }
}