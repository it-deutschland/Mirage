document.querySelectorAll('.alert').forEach((el) => {
  setTimeout(() => el.classList.add('fade'), 3800);
});

document.querySelectorAll('[data-tilt-card]').forEach((card) => {
  const strength = 10;
  let frame = null;
  let pointer = null;

  const renderTilt = () => {
    if (!pointer) {
      frame = null;
      return;
    }

    const rect = card.getBoundingClientRect();
    const px = (pointer.x - rect.left) / rect.width;
    const py = (pointer.y - rect.top) / rect.height;
    const rotateY = (px - 0.5) * strength;
    const rotateX = (0.5 - py) * strength;

    card.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-3px)`;
    frame = null;
  };

  card.addEventListener('mousemove', (event) => {
    pointer = { x: event.clientX, y: event.clientY };

    if (frame === null) {
      frame = window.requestAnimationFrame(renderTilt);
    }
  });

  card.addEventListener('mouseleave', () => {
    pointer = null;
    if (frame !== null) {
      window.cancelAnimationFrame(frame);
      frame = null;
    }
    card.style.transform = '';
  });
});

document.querySelectorAll('.amount-grid').forEach((grid) => {
  const updateSelection = () => {
    grid.querySelectorAll('.amount-card').forEach((card) => {
      const input = card.querySelector('input[type="radio"]');
      card.classList.toggle('is-selected', Boolean(input?.checked));
    });
  };

  grid.addEventListener('change', updateSelection);
  updateSelection();
});
