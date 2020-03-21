<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\service\user\LinkService;
use App\Http\common\Constant\ViewPath;
use App\Http\common\Service\CommonService;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private $request;
    private $linkService;
    private $commonService;

    public function __construct(
        Request $request,
        LinkService $linkService,
        CommonService $commonService
    ) {
        $this->request = $request;
        $this->linkService = $linkService;
        $this->commonService = $commonService;
    }

    public function showAddLinkForm($userAccount)
    {
        $idNewLink = $this->linkService->getLatestLinkId($userAccount);
        return view(ViewPath::USER_ADD_lINK, ['userAccount' => $userAccount, 'idNewLink' => $idNewLink]);
    }

    public function addLinkForm()
    {
        $user = $this->commonService->getUserByUserAccount($this->request->userAccount);
        if ($user == null) {
            return redirect()->back()->with('error', 'Người dùng không hợp lệ!');
        }
        $isAddLinkSuccess = $this->linkService->add($user->name, $this->request->linkId, $this->request->linkName);
        $message = $isAddLinkSuccess == true ? 'Thêm link thành công!' : 'Thêm link thất bại, hãy thử lại!';
        return redirect('/')->with('msg', $message);
    }

    public function showEditLinkForm($userAccount, $linkId)
    {
        // return view()->with('','');
    }

    public function editLinkForm($userAccount, $linkId)
    {
        // return view()->with('','');
    }

    public function remove($userAccount, $linkId)
    {
        $isRemove = $this->linkService->remove($userAccount, $linkId);
        return redirect()->back()->with('success', 'Xoá link thành công!');
    }
}
