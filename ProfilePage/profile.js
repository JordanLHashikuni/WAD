// Placeholder: username
document.getElementById("username").textContent = localStorage.getItem("username") || "Student";

// Fetch saved timetables from localStorage
const timetables = JSON.parse(localStorage.getItem("timetables")) || [];

const container = document.getElementById("timetableContainer");

function renderTimetables() {
    container.innerHTML = "";
    timetables.forEach((tt, index) => {
        const card = document.createElement("div");
        card.classList.add("timetable-card");
        card.innerHTML = `
          <h3>${tt.name}</h3>
          <button class="edit-btn" data-index="${index}"><i class="fas fa-edit"></i> Edit</button>
          <button class="delete-btn" data-index="${index}"><i class="fas fa-trash-alt"></i> Delete</button>
          <button class="export-btn" data-index="${index}"><i class="fas fa-file-pdf"></i> Export</button>
`;

        container.appendChild(card);
    });
}

renderTimetables();

// Handle edit/delete/export clicks
container.addEventListener("click", (e) => {
    const index = e.target.dataset.index;
    if(e.target.classList.contains("edit-btn")){
        alert(`Edit timetable #${index}`); // Replace with edit functionality
    }
    if(e.target.classList.contains("delete-btn")){
        if(confirm("Are you sure you want to delete this timetable?")){
            timetables.splice(index,1);
            localStorage.setItem("timetables", JSON.stringify(timetables));
            renderTimetables();
        }
    }
    if(e.target.classList.contains("export-btn")){
        alert(`Export timetable #${index}`); // Replace with actual export/print
    }
});
