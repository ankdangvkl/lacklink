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
        if ($this->request->linkName == null || $this->request->linkId == null) {
            return redirect()->back()->with('msg', 'Id cua link hoac ten link khong duoc trong!');
    }
        $user = $this->commonService->getUserByUserAccount($this->request->userAccount);
        if ($user == null) {
            return redirect()->back()->with('error', 'Người dùng không hợp lệ!');
        }
        $isDuplicateContent = $this->linkService->checkDuplicateLinkContent(
            $this->request->userAccount,
            $this->request->linkName,
            $this->request->linkId
        );
        if ($isDuplicateContent == true) {
            return redirect()->back()->with('msg', 'Link da ton tai! Hay nhap link khac!');
        }
        $isAddLinkSuccess = $this->linkService->add($user->user_account, $this->request->linkId, $this->request->linkName);
        $message = $isAddLinkSuccess == true ? 'Thêm link thành công!' : 'Thêm link thất bại, hãy thử lại!';
        return redirect('/')->with('msg', $message);
    }

    public function showEditLinkForm($userAccount, $linkId)
    {
        return view(ViewPath::USER_EDIT_lINK, [
            'linkName' => $this->linkService->getLinkContentByLinkId($userAccount, $linkId),
            'userAccount' => $userAccount,
            'linkId' => $linkId
        ]);
    }

    public function editLinkForm()
    {
        $isEditSucc = $this->linkService->edit(
            $this->request->userAccount,
            $this->request->linkName,
            $this->request->linkId
        );
        if (!$isEditSucc) {
            return redirect()->back()->with('msg', 'Cập nhật link thành công!');
        }
        return redirect('/')->with('msg', 'Cập nhật link không thành công. Hãy thử lại!');
    }

    public function remove($userAccount, $linkId)
    {
        $isRemove = $this->linkService->remove($userAccount, $linkId);
        return redirect()->back()->with('success', 'Xoá link thành công!');
    }
}
