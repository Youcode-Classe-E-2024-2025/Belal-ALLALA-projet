// open create team form

const addTeamBtn = document.querySelector(".add-team-btn");
const addTeamForm = document.querySelector(".add-team-form");

const addmemberBtn = document.querySelector(".add-member-btn");
const addmemberForm = document.querySelector(".add-member-form");

const memberBtn = document.querySelector(".member-btn");
const memberForm = document.querySelector(".member-form");

addTeamBtn?.addEventListener("click", function (e) {
	addTeamForm.classList.remove("hidden");
});

addmemberBtn?.addEventListener("click", function (e) {
	addmemberForm.classList.remove("hidden");
});

memberBtn?.addEventListener("click", function (e) {
	memberForm.classList.remove("hidden");
});

// add members
// const teamMembers = [];

// const addMemberBtn = document.querySelector(".add-member-btn");
// const selectedMember = document.querySelector("select.selected-member");
// const membersContainer = addTeamForm?.querySelector(".members");

// addMemberBtn?.addEventListener("click", function (e) {
// 	console.log(selectedMember.textContent);
// 	teamMembers.push(selectedMember.textContent);
// 	membersContainer.innerHTML = teamMembers.map((member) => `<li>${member}</li>`).join("");
// });

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
// const editTaskBtns = document.querySelectorAll(".edit-task-btn");
// const editForm = document.querySelector(".edit-task-form");

// editTaskBtns.forEach((btn) =>
// 	btn?.addEventListener("click", function (e) {
// 		editForm.classList.remove("hidden");
// 		const id = btn.id;
// 		editForm.querySelector("input#id").value = id;
// 		fetch(`http://localhost/controllers/task/get.php?action=getUser&id=${id}`)
// 			.then((res) => res.json())
// 			.then((data) => {
// 				console.log(data);
// 				console.log(data.deadline.split(" ")[0]);
// 				console.log(data.deadline.split(" ")[1]);
// 				console.log(data.type);

// 				editForm.querySelector("#title").value = data.titre;
// 				editForm.querySelector("#description").value = data.description;
// 				editForm.querySelector("#date").value = data.deadline.split(" ")[0];
// 				editForm.querySelector("#time").value = data.deadline.split(" ")[1];
// 				editForm.querySelector("#statut").value = data.statut;
// 				editForm.querySelector("#type").value = data.type;
// 			})
// 			.catch((error) => console.error(error));
// 	})
// );

document.querySelectorAll('.task-icon').forEach(icon => {
    icon.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        let taskDiv = icon.closest('.task');
        let taskId = taskDiv.querySelector('input[name="task_id"]').value;
        let section = document.getElementById('hiddenSection'+taskId);
        if (!section) {
            console.warn(`Section avec l'ID 'hiddenSection${taskId}' introuvable.`);
            return;
        }
        section.classList.toggle('hidden');
    });
});

