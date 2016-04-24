export function getAll() {
    return window.$.getJSON(`/api/v1/daily-appliances`)
}

export function get(projectId, queries = {}) {
    let queryArray = []

    if (queries.date) {
        queryArray.push(`date=${queries.date}`)
    }

    const queryString = queryArray.join('&')

    return window.$.getJSON(`/api/v1/projects/${projectId}/daily-appliances?${queryString}`)
}

export function getTotalAmount(projectId) {
    return window.$.getJSON(`/api/v1/projects/${projectId}/daily-appliances/total-amount`)
}

export function create(projectId, values) {
    return window.$.post(`/api/v1/projects/${projectId}/daily-appliances`, values)
}
