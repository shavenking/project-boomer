export function get(projectId, queries = {}) {
    let queryArray = []

    if (queries.date) {
        queryArray.push(`date=${queries.date}`)
    }

    const queryString = queryArray.join('&')

    return window.$.getJSON(`/api/v1/projects/${projectId}/daily-records?${queryString}`)
}

export function create(projectId, values) {
    return window.$.post(`/api/v1/projects/${projectId}/daily-records`, values)
}
