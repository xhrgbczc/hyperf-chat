<?php

namespace App\Service;


class SocketRoomService
{
    const ROOM = 'ws:room';
    
    /**
     * 获取房间名
     *
     * @param string|integer $room 房间名
     * @return string
     */
    public function getRoomName($room)
    {
        return sprintf('%s:%s', self::ROOM, $room);
    }

    /**
     * 获取房间成员
     *
     * @param string $room 房间名
     * @return array
     */
    public function getRoomMembers(string $room)
    {
        return redis()->sMembers($this->getRoomName($room));
    }

    /**
     * 成员加入房间
     *
     * @param int $usr_id 用户ID
     * @param string|array $room 房间名
     * @return bool|int
     */
    public function addRoomMember(int $usr_id, $room)
    {
        return redis()->sAdd($this->getRoomName($room), $room);
    }

    /**
     * 成员退出房间
     *
     * @param string|array $room 房间名
     * @param string|array $members 用户ID
     */
    public function delRoomMember($room, $members)
    {
        return redis()->sRem($this->getRoomName($room), $members);
    }
}