<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\PollRequest;
use App\Models\Poll;
use App\Models\PollVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

    class PollController extends Controller {

        public function __construct()
        {
            $this->middleware('auth');
        }
        public function index(): View
        {
            return view(
                'admin.poll.index',
                [
                    'models' => Poll::query()->get(),
                ]
            );
        }
        
        public function create(): View
        {
            return view(
                'admin.poll.create'
            );
        }
    
        public function show(Poll $poll): View
        {
            return view('pages.poll.index', ['poll' => $poll]);
        }
    
        public function store(PollRequest $request): RedirectResponse
        {
            $poll = new Poll($request->validated());
            $poll->save();
    
            return redirect(route('poll.index'));
        }
    
        public function storeVariant(Poll $poll, Request $request): RedirectResponse
        {
            $variant = new PollVariant($request->validate(['text' => 'required|max:500']));
            $variant->poll_id = $poll->id;
            $variant->save();
            return redirect()->route('poll.edit', [$poll]);
        }
    
        public function edit(Poll $poll): View
        {
           
            return view('admin.poll.edit', ['model' => $poll]);
        }

        public function updateVariant(Poll $poll, PollVariant $variant, Request $request)
        {
            $variant->text=$request->input('text');
            $variant->save();
            return view('admin.poll.edit', ['model' => $poll]);
        }
    
        public function update(PollRequest $request, Poll $poll): RedirectResponse
        {
            $poll->fill($request->validated());
            $poll->save();
    
            return redirect()->route('poll.index');
        }
    
        public function destroy(Poll $poll): RedirectResponse
        {
            $poll->delete();
    
            return redirect()->route('poll.index');
        }
    
        public function destroyVariant(Poll $poll, PollVariant $variant): RedirectResponse
        {
            $variant->delete();
    
            return redirect()->route('poll.edit', [$poll]);
        }
    }
?>