// script.js

// Функция для открытия модального окна
function showModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";
}

// Функция для закрытия модального окна
function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
}

// Инициализация при загрузке страницы
window.onload = function() {
  // Добавляем обработчики для всех модальных окон
  var modals = document.querySelectorAll('.modal');
  modals.forEach(function(modal) {
      var closeBtn = modal.querySelector('.close');
      closeBtn.onclick = function() {
          modal.style.display = "none";
      }
  });

  // Закрыть модальное окно при клике вне его
  window.onclick = function(event) {
      modals.forEach(function(modal) {
          if (event.target === modal) {
              modal.style.display = "none";
          }
      });
  };
};
