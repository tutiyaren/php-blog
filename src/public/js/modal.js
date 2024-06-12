
const memberCondition = document.getElementById('memberCondition');
const openCondition = document.getElementById('openCondition');
const closeButton = document.getElementById('closeButton');
const memberOverlay = document.getElementById('memberOverlay');

memberCondition.addEventListener('click', async () => {
  await showModal();
});

closeButton.addEventListener('click', async () => {
  await closeModal();
});

memberOverlay.addEventListener('click', async (event) => {
  if (event.target === memberOverlay) {
    await closeModal();
  }
});

async function showModal() {
  memberOverlay.classList.add('active');
  openCondition.showModal();
}

async function closeModal() {
  openCondition.close();
  memberOverlay.classList.remove('active');
}
