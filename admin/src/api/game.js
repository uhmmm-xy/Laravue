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
        url    : "game/server/list",
        method : 'get'
    })
}

export const getMapList = () => {
    return service({
        url    : "game/map/list",
        method : 'get'
    })
}
