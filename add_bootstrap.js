const link = document.createElement('link');
link.rel = 'stylesheet';
link.href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css';
link.integrity = 'sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ';
link.crossOrigin = 'anonymous';
document.head.appendChild(link);

const script = document.createElement('script');
script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js';
script.integrity = 'sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe';
script.crossOrigin = 'anonymous';
document.body.appendChild(script);

function createNavbar() {
  const navbar = document.createElement('nav');
  navbar.classList.add('navbar', 'navbar-expand-lg', 'bg-info', 'bg-opacity-50');
  navbar.setAttribute('dir', 'ltr');
  navbar.innerHTML = `
    <div class="container-fluid ">
      <a class="navbar-brand display-6 text-info-emphasis" href="index.php">Ṭask൬aster&copy;</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent" dir="rtl">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 pe-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">דף התחברות</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-primary-emphasis" aria-current="page" href="signup.php">הרשמה</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  disabled" aria-current="page" href="home.php">הרשימות שלי</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  disabled" aria-current="page" href="list.php">רשימה לדוגמא</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle disabled" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> המשימות שלי </a>
            <ul class="dropdown-menu bg-info-subtle">
              <li><a class="dropdown-item" href="#">לנקות חול לחתולים</a></li>
              <li><a class="dropdown-item" href="#">להכין לזניה</a></li>
              <li><a class="dropdown-item" href="#">לעשות תרגיל בית בפיתוח Web</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="חפש משימה..." aria-label="Search">
          <button class="btn btn-outline-success bg-info-subtle me-1 disabled" type="submit">חפש</button>
        </form>  
      </div>
    </div>`;

  document.body.prepend(navbar);
}

function createLoggedNavbar() {
  const navbar = document.createElement('nav');
  navbar.classList.add('navbar', 'navbar-expand-lg', 'bg-info', 'bg-opacity-50');
  navbar.setAttribute('dir', 'ltr');
  navbar.innerHTML = `
    <div class="container-fluid ">
      <a class="navbar-brand display-6 text-info-emphasis" href="home.php">Ṭask൬aster&copy;</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent" dir="rtl">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 pe-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">הרשימות שלי</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="list.php">רשימה לדוגמא</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle disabled" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> המשימות שלי </a>
            <ul class="dropdown-menu bg-info-subtle">
              <li><a class="dropdown-item" href="#">לנקות חול לחתולים</a></li>
              <li><a class="dropdown-item" href="#">להכין לזניה</a></li>
              <li><a class="dropdown-item" href="#">לעשות תרגיל בית בפיתוח Web</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav">
        <li class="nav-item">
          <a id="logoutLink" class="nav-link active text-danger-emphasis" aria-current="page" href="logout.php">התנתקות</a>
        </li>
      </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="חפש משימה..." aria-label="Search">
          <button class="btn btn-outline-success bg-info-subtle me-1 disabled" type="submit">חפש</button>
        </form>
      </div>
    </div>`;
  document.body.prepend(navbar);
}

function createFooter() {
  const footer = document.createElement('footer');
  footer.innerHTML = `
    <div class="card-footer bg-transparent border-success" dir="rtl">
      <nav class="navbar navbar-expand-sm bg-info bg-opacity-25">
        <div class="container-fluid">
          <a class="navbar-brand display-6 text-info-emphasis " href="index.php">&copy;Ṭask൬aster</a>
          <ul class="navbar-nav mb-2 mb-lg-0 pe-0" dir="rtl">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">דף התחברות</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">עלינו</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">צור קשר</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> תנאי השימוש</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  `;
  document.body.append(footer);
}

function createLoggedFooter() {
  const footer = document.createElement('footer');
  footer.innerHTML = `
    <div class="card-footer bg-transparent border-success" dir="rtl">
      <nav class="navbar navbar-expand-sm bg-info bg-opacity-25">
        <div class="container-fluid">
          <a class="navbar-brand display-6 text-info-emphasis " href="home.php">&copy;Ṭask൬aster</a>
          <ul class="navbar-nav mb-2 mb-lg-0 pe-0" dir="rtl">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="home.php">דף הרשימות שלי</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">עלינו</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">צור קשר</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> תנאי השימוש</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  `;
  document.body.append(footer);
}

function validateLoginForm(event) {
  event.preventDefault();
  const emailInput = document.getElementById('inputEmail3');
  const email = emailInput.value.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert('יש להכניס כתובת אימייל חוקית');
    return false;
  }

  const passwordInput = document.getElementById('inputPassword3');
  if (emailInput.value === '' || passwordInput.value === '') {
    alert('אנא מלא את כל השדות');
    return false;
  }
  window.location.href = "home.php";
  return true;
}

document.getElementById('logoutLink').addEventListener('click', logoutUser);
function logoutUser() {
  document.cookie = 'Email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
  window.location.href = 'index.php'; // Redirect the user to index.php
}
