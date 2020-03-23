<?php

namespace App\Http\service\user;

use App\Http\repositories\LinkRepository;
use App\Http\common\Repositories\CommonRepository;
use App\Http\common\Constant\FilePath;

class LinkService
{
    private $linkRepository;
    private $commonRepository;

    private $listFakeLink;

    public function __construct(LinkRepository $linkRepository, CommonRepository $commonRepository)
    {
        $this->linkRepository = $linkRepository;
        $this->commonRepository = $commonRepository;
    }

    public function add($userAccount, $linkId, $linkName)
    {
        $this->listFakeLink = $this->getUserListFakeLink($userAccount);
        $this->listFakeLink[$linkId] = $linkName;
        if (\File::put(
            public_path(FilePath::USER_FILE_PATH . $userAccount . FilePath::USER_FAKE_LINK_JSON_FILE),
            json_encode($this->listFakeLink))) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($userAccount, $linkName, $linkId)
    {
        if ($userAccount == null || $linkName ==  null || $linkId == null) {
            return false;
        }
       $this->listFakeLink = $this->getUserListFakeLink($userAccount);
       $this->listFakeLink[$linkId] = $linkName;
       if (\File::put(public_path(
        FilePath::USER_FILE_PATH . $userAccount . FilePath::USER_FAKE_LINK_JSON_FILE),
        json_encode($this->listFakeLink))) {
            return true;
        } else {
            return false;
        }
    }

    public function getLinkContentByLinkId($userAccount, $linkId)
    {
        $this->listFakeLink = $this->getUserListFakeLink($userAccount);
        return $this->listFakeLink[$linkId];
    }

    public function checkDuplicateLinkContent($userAccount, $linkContent, $linkId)
    {
        $this->listFakeLink = $this->getUserListFakeLink($userAccount);
        foreach ($this->listFakeLink as $key => $content) {
            if ($content == $linkContent) {
                return true;
            }
            if ($key == $linkId) {
                return true;
            }
        }
        return false;
    }

    public function remove($userAccount, $linkId)
    {
        if ($this->commonRepository->getUserByUserAccount($userAccount) == null) {
            return false;
        }
        $this->listFakeLink = $this->getUserListFakeLink($userAccount);
        if (count($this->listFakeLink) == 0) {
            return;
        }
        $listLinkAfterRemove = $this->removeLinkFromListLink($this->listFakeLink, $linkId);
        \File::put(public_path(
            FilePath::USER_FILE_PATH . $userAccount . FilePath::USER_FAKE_LINK_JSON_FILE),
            json_encode($listLinkAfterRemove));
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

    public function isDuplicateKey($userAccount)
    {
        $this->getUserListFakeLink($userAccount);
        return false;
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
