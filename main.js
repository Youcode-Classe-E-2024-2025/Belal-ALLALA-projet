// open create team form

const addTeamBtn = document.querySelector(".add-team-btn");
const addTeamForm = document.querySelector(".add-team-form");

addTeamBtn?.addEventListener("click", function (e) {
	addTeamForm.classList.remove("hidden");
});

// add members
const teamMembers = [];

const addMemberBtn = document.querySelector(".add-member-btn");
const selectedMember = document.querySelector("select.selected-member");
const membersContainer = addTeamForm?.querySelector(".members");

addMemberBtn?.addEventListener("click", function (e) {
	// console.log(teamMembers);
	teamMembers.push(selectedMember.value);
	membersContainer.innerHTML = teamMembers.map((member) => `<li>${member}</li>`).join("");
});

// close the form
const closeBtns = document.querySelectorAll(".close-btn");
closeBtns.forEach((btn) =>
	btn?.addEventListener("click", function (e) {
		btn.closest(".overlay").classList.add("hidden");
	})
);

// open add task form
const addTaskBtn = document.querySelector(".add-task-btn");
const addTaskForm = document.querySelector(".add-task-form");

addTaskBtn?.addEventListener("click", function (e) {
	addTaskForm.classList.remove("hidden");
});

// assign to someone
const assignedMembers = [];
const assignedTo = document.querySelector("#assignedTo");
const assignedMembersContainer = document.querySelector(".assigned-members");
assignedTo?.addEventListener("change", function (e) {
	assignedMembers.push(assignedTo.value);
	assignedMembersContainer.innerHTML += `<li>${assignedTo.value}</li>`;
});

// open edit task form
const editTaskBtns = document.querySelectorAll(".edit-task-btn");
const editForm = document.querySelector(".edit-task-form");

editTaskBtns.forEach((btn) =>
	btn?.addEventListener("click", function (e) {
		editForm.classList.remove("hidden");
		editForm.querySelector("input#id").value = "test";
	})
);
