const editButtons = document.querySelectorAll(".btn-edit");
const deleteButtons = document.querySelectorAll(".btn-delete");
const editModal = document.querySelector("#edit-user-modal");
const deleteModal = document.querySelector("#delete-user-modal");

editModal.addEventListener("show.bs.modal", function () {});

editButtons.forEach((btn) => {
  btn.addEventListener("click", function () {
    const id = btn.dataset.id;
    fetchUserDetails(id);
  });
});

deleteButtons.forEach((btn) => {
  btn.addEventListener("click", function () {
    const id = btn.dataset.id;
    deleteModal.querySelector("#user-id").value = id;
    const modal = new bootstrap.Modal(deleteModal);
    modal.show();
  });
});

async function fetchUserDetails(id) {
  try {
    const url = `users-get.php?id=${id}`;
    const response = await fetch(url);
    const data = await response.json();
    populateEditModal(data);
  } catch (error) {
    console.error(error);
  }
}

function populateEditModal(user) {
  editModal.querySelector("#user-id").value = user.id;
  editModal.querySelector("#username").value = user.username;
  editModal.querySelector("#fullname").value = user.fullname;
  editModal.querySelector("#role").value = user.role;

  const modal = new bootstrap.Modal(editModal);
  modal.show();
}
