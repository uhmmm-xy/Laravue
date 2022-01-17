import service from '@/utils/request'

export const getOnline = (data) => {
    return service({
        url: "/game/statis/getOnline",
        method: 'GET',
        data
    })
}

export const getOnlineTime = (data) => {
    return service({
        url: "/game/statis/getOnlineTime",
        method: 'GET',
        data
    })
}

export const getStatisDay = (params) => {
    return service({
        url: "/game/statis/getStatisDay",
        method: 'GET',
        params
    })
}

export const getDayPreserve = (params) => {
    return service({
        url: "/game/statis/getDayPreserve",
        method: 'POST',
        params
    })
}