<?php 
namespace App\Http\Controllers;
use App\Http\Requests\PollRequest;
use App\Models\Poll;
use App\Models\PollVariant;
use App\Models\PollAnswer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

    class PublicPollController extends Controller {

        public function index(): View
        {
            return view(
                'pages.poll.index',
                [
                    'polls' => Poll::query()->get(),
                ]
            );
        }
        
        public function show(Poll $poll): View
        {
            return view('pages.poll.show', ['poll' => $poll]);
        }
        public function data(Poll $poll): View
        {
            return view('pages.poll.data', ['poll' => $poll]);
        }
        public function getAnswersData(Poll $poll)
        {
            $res=[];
            $ans = $poll->getAnswers()->get();
            $vars = $poll->getVariants()->get();
            foreach($vars as $v)
            {
                $count=0;
                foreach($ans as $a)
                {
                    if($a->poll_variant_id==$v->id)
                    {
                        ++$count;
                    }
                }
                $res[]=[$v->text,$count];
            }
            return response()->json($res);
        }
        public function createAnswer(Request $request): RedirectResponse
        {
            $answer = new PollAnswer();
            $answer->poll_variant_id=$request->input('pull_variant_id');
            $answer->save();
            if( Auth::check())
            {
                return redirect()->route('poll.index');
            }
            return redirect()->route('poll.public-index');
           
        }
    }
?>