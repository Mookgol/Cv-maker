var skill_count=1;
var experience_count=1;
let softSkillCount = 1;

function addSkill() {
    let addSkill = document.getElementById('addSkill');
    let skillHide = document.getElementById('skill_hide');
    if (skill_count < 5) {
        skill_count++;
        var field = `
                <div class="mb-3">
                    <label class="form-label">Skillset Name</label>
                    <input type="text" class="form-control" name="skill${skill_count}" required>
                    <select class="form-select mt-2" name="skill_level${skill_count}" required>
                        <option value="">Select stars based upon your skill level</option>
                        <option value="1">1 - Novice</option>
                        <option value="2">2 - Advanced Beginner</option>
                        <option value="3">3 - Competent</option>
                        <option value="4">4 - Proficient</option>
                        <option value="5">5 - Expert</option>
                    </select>
                </div>`;
        var htmlObject = document.createElement('div');
        htmlObject.innerHTML = field;
        addSkill.appendChild(htmlObject);
    }
    if (skill_count == 5) {
        skillHide.style.display = "none";
    }

}

function addSoftSkill() {
    softSkillCount++;
    if (softSkillCount <= 5) {
        const softSkillDiv = document.createElement('div');
        softSkillDiv.classList.add('mb-3');
        softSkillDiv.innerHTML = `
                <label class="form-label">Soft Skill Name</label>
                <input type="text" class="form-control" name="softskill${softSkillCount}" required>
                <select class="form-select mt-2" name="softskill_level${softSkillCount}" required>
                    <option value="">Select stars based upon your skill level</option>
                    <option value="1">1 - Novice</option>
                    <option value="2">2 - Advanced Beginner</option>
                    <option value="3">3 - Competent</option>
                    <option value="4">4 - Proficient</option>
                    <option value="5">5 - Expert</option>
                </select>
            `;
        document.getElementById('addSoftSkill').appendChild(softSkillDiv);
    } else {
        alert('Maximum of 5 soft skills can be added.');
    }
}

function addExperience() {
    let addExperience = document.getElementById('addExperience');
    let experienceHide = document.getElementById('experience_hide');
    if(experience_count < 3) {
        experience_count++;
        var field = `
                <div class="mb-3">
                    <label for="title${experience_count}" class="form-label">Title ${experience_count}</label>
                    <input type="text" name="title${experience_count}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description${experience_count}" class="form-label">Description ${experience_count}</label>
                    <input type="text" name="description${experience_count}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="year${experience_count}" class="form-label">Year ${experience_count}</label>
                    <input type="number" name="year${experience_count}" class="form-control" required>
                </div>`;
        var htmlObject = document.createElement('div');
        htmlObject.innerHTML = field;
        addExperience.appendChild(htmlObject);
    }
    if(experience_count == 3) {
        experienceHide.style.display = "none";
    }
}

