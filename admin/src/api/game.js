import service from '@/utils/request'

export const sendMail = (data)=>{
    return service({
        url    : "/game/mail/send",
        method : 'POST',
        data   : data
    })
}

export const getMailList = () => {
    return [];
}

export const getZoneList = () => {
    return service({
        url    : "/game/server/list",
        method : 'get'
    })
}

export const getMapList = () => {
    return service({
        url    : "/game/map/list",
        method : 'get'
    })
}

export const getNodeList = () => {
    return service({
        url    : "/game/node/list",
        method : 'get'
    })
}




// 创建Notice
export const createNotice = (data) => {
    return service({
        url: "/game/notice",
        method: 'POST',
        data
    })
}

// 更具ID或IDS 删除Notice
export const deleteNotice = (id) => {
    return service({
        url: `/game/notice/${id}`,
        method: 'DELETE',
    })
}

// 更新Notice
export const updateNotice = (id, data) => {
    return service({
        url: `/game/notice/${id}`,
        method: 'PUT',
        data
    })
}

// 根据idNotice
export const findNotice = (type) => {
    return service({
        url: `/game/notice/find/${type}`,
        method: 'GET',
    })
}

// 分页获取Notice列表
export const getNoticeList = (params) => {
    return service({
        url: "/game/notice/list",
        method: 'GET',
        params
    })
}

//获取角色信息
export const getUser = (params) => {
    return service({
        url: "/game/tool/getUser",
        method: 'POST',
        params
    })
}


export const updateUserStatus = (params) => {
    return service({
        url: "/game/tool/setUserStatus",
        method: 'POST',
        params
    })
}