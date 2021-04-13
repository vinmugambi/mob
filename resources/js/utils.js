function formatDate(date) {
    return new Date(date).toLocaleString("en-GB", {
        day: "numeric",
        month: "short",
    });
}
export { formatDate };
