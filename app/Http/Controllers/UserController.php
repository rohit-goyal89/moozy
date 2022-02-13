<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\User;
use App\UserDetail;
use App\Models\UserRating;
use Flash;
use Response;
use Illuminate\Support\Facades\Validator;
use Hash;
use DB;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository, $user;

    public function __construct(UserRepository $userRepo, User $user)
    {
        $this->userRepository = $userRepo;
        $this->user = $user;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (empty($request->role)) {
            Flash::error('Invalid Url');

            return redirect('home');
        }

        $users = $this->user->where('role_id','=',$request->role)->paginate(15)
;
        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (empty($request->role)) {
            Flash::error('Invalid Url');

            return redirect('home');
        }
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $user = User::create($input);
        $user->assignRole($request->input('role_id'));
        $user = User::with('userDetail')->findOrFail($user->id);
        // if ($user->userDetail === null)
        // {
        $imageName = $licenceName = "";
        if($request->photo) {
            $imageName = time().'.'.$request->photo->extension();  

            $request->photo->move(public_path('images'), $imageName);
        }
        
        if($request->licence_file) {

            $licenceName = time().'.'.$request->licence_file->extension();  

            $request->licence_file->move(public_path('images'), $licenceName);
        }
        if(!empty($request->photo) || !empty($request->licence_file)) {
            $userInfo = new UserDetail(['photo' => $imageName,'licence_file' => $licenceName]);
            $user->userDetail()->save($userInfo);
        }
       // }
        // else
        // {
        //     $user->userDetail()->update(['photo' => 'Test','licence_file' => 'Test']);
        // }

        Flash::success('User saved successfully.');
        return redirect()->route('users.index', ['role' => $user->role_id]);
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        if (empty($request->role)) {
            Flash::error('Invalid Url');

           return redirect('home');
        }
        $user = $this->user->with(['userDetail'])->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if (empty($request->role)) {
            Flash::error('Invalid Url');

           return redirect('home');
        }
        $user = $this->user->with('userDetail')->find($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            unset($input['password']);    
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('role_id'));
        $imageName = $licenceName = "";
        if($request->photo) {
            $imageName = time().'.'.$request->photo->extension();  

            $request->photo->move(public_path('images'), $imageName);
        }
        
        if($request->licence_file) {

            $licenceName = time().'.'.$request->licence_file->extension();  

            $request->licence_file->move(public_path('images'), $licenceName);
        }
        if(!empty($request->photo) || !empty($request->licence_file)) {
            if ($user->userDetail === null)
            {
                $userInfo = new UserDetail(['photo' => $imageName,'licence_file' => $licenceName]);
                $user->userDetail()->save($userInfo);
            }
            else
            {
                $user->userDetail()->update(['photo' => $imageName,'licence_file' => $licenceName]);
            }
        }
        Flash::success('User updated successfully.');

        return redirect()->route('users.index', ['role' => $user->role_id]);
        //return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect()->route('users.index', ['role' => $user->role_id]);
    }

    public function ratingAndReview(Request $request)
    {
        $rating = UserRating::with(['users', 'drivers'])->get();
        return view('users.create');
    }
}
