<?php

namespace App\Http\service\user;

use App\Http\repositories\LinkRepository;
use App\Http\common\Repositories\CommonRepository;
use App\Http\common\Constant\FilePath;

class LinkService
{
    private $linkRepository;
    private $commonRepository;

    public function __construct(LinkRepository $linkRepository, CommonRepository $commonRepository)
    {
        $this->linkRepository = $linkRepository;
        $this->commonRepository = $commonRepository;
    }

    public function add($userAccount, $linkId, $linkName)
    {
        $listFakeLink = $this->getUserListFakeLink($userAccount);
        $listFakeLink[$linkId] = $linkName;
        if (\File::put(public_path(FilePath::USER_FILE_PATH . $userAccount . FilePath::USER_FAKE_LINK_JSON_FILE), json_encode($listFakeLink))) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($userAccount, $linkId)
    {
    }

    public function getLinkContentByLinkId($userAccount, $linkId)
    {
        $listFakeLink = $this->getUserListFakeLink($userAccount);
        return $listFakeLink[$linkId];
    }

    public function remove($userAccount, $linkId)
    {
        if ($this->commonRepository->getUserByUserAccount($userAccount) == null) {
            return false;
        }
        $listFakelink = $this->getUserListFakeLink($userAccount);
        if (count($listFakelink) == 0) {
            return;
        }
        $listLinkAfterRemove = $this->removeLinkFromListLink($listFakelink, $linkId);
        \File::put(public_path(FilePath::USER_FILE_PATH . $userAccount . FilePath::USER_FAKE_LINK_JSON_FILE), json_encode($listLinkAfterRemove));
        return;
    }

    public function getUserListFakeLink($userAccount)
    {
        return (array) $this->commonRepository->getUserListFakeLink($userAccount);
    }

    public function getLatestLinkId($userAccount)
    {
        return (array_key_last($this->getUserListFakeLink($userAccount)) + 1);
    }

    private function removeLinkFromListLink($listFakeLink, $linkId)
    {
        foreach ($listFakeLink as $key => $link) {
            if ($key == $linkId) {
                unset($listFakeLink[$key]);
                break;
            }
        }
        return $listFakeLink;
    }
}
