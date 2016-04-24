export function getAll() {
    return window.$.getJSON(`/api/v1/daily-labors`)
}

export function get(projectId, queries = {}) {
    let queryArray = []

    if (queries.date) {
        queryArray.push(`date=${queries.date}`)
    }

    const queryString = queryArray.join('&')

    return window.$.getJSON(`/api/v1/projects/${projectId}/daily-labors?${queryString}`)
}

export function getTotalAmount(projectId) {
    return window.$.getJSON(`/api/v1/projects/${projectId}/daily-labors/total-amount`)
}

export function create(projectId, values) {
    return window.$.post(`/api/v1/projects/${projectId}/daily-labors`, values)
}
