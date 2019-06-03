export default {
    deletePost: id => {
        const confirmDelete = confirm("Вы действительно хотите удалить запись ?");
        if (confirmDelete) {
            axios.post(`/post/${id}`, {
                "id": id,
                "_method": 'DELETE',
                "_token": window.token,
            }).then(response => {
                $(`[data-id-card=${id}]`).css('display', 'none');
            })
        }
    }
}
