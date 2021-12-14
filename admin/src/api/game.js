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

export const getZoneList = (data) => {
    return service({
        url    : "game/server/list",
        method : 'get',
        data   : data
    })
}