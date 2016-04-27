export function getProjectWorks(projectId, queries = []) {
    let queryArray = []

    if (queries.mainflow_type_id) {
        queryArray.push(`mainflow_type_id=${queries.mainflow_type_id}`)
    }

    if (queries.detailingflow_type_id) {
        queryArray.push(`detailingflow_type_id=${queries.detailingflow_type_id}`)
    }

    const queryString = queryArray.join('&')

    return window.$.getJSON(`/api/v1/projects/${projectId}/works?${queryString}`)
}
