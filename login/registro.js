function showContent(contentId) {

    // Obtén todas las pestañas
  
    const tabs = document.querySelectorAll('.nav-link');
  
  
    // Recorre todas las pestañas y quita la clase 'active'
  
    tabs.forEach(tab => {
  
      tab.classList.remove('active');
  
    });
  
  
    // Agrega la clase 'active' al enlace seleccionado
  
    const selectedTab = document.querySelector(`[onclick="showContent('${contentId}')"]`);
  
    selectedTab.classList.add('active');
  
  
    // Oculta y muestra el contenido correspondiente
  
    const contents = document.querySelectorAll('.card-body > div');
  
    contents.forEach(content => {
  
      content.style.display = 'none';
  
    });
  
    document.getElementById(contentId).style.display = 'block';
  
  }