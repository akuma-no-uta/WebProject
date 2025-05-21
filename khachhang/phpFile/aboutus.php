<?php
include_once '../phpFile/header.php';    

?>
<main>
    <style>
        * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
body {
  background-color: #fbf6dc;
  overflow-x: hidden;
}
#timeline ul {
  padding: 50px 0;
}
#timeline ul li {
  list-style: none;
  position: relative;
  width: 7px;
  margin: 0 auto;
  padding-top: 50px;
  background-color: aliceblue;
}
#timeline ul li .box {
  position: relative;
  bottom: 0;
  width: 450px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
  border-radius: 5px;
  transform: translateX(400%);
}
#timeline ul li .box.show {
  transform: translateX(0%);
  transition: all 0.5s ease-in-out;
}
.heading {
  background-color: #fbf6dc;
  text-align: center;
  font-size: 3rem;
}
.title {
  top:50px;

  box-shadow: 10px 5px 10px rgba(0, 0, 0, 0.6);
  padding: 1rem 1rem 1rem, 0.7rem;
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
  color: white;
  font-size: 1.3rem;
  background-color: #de3163;
  height: 40px;
}
.year {
  background-color: #de3163;
  padding: 0.3rem 0.5rem;
  margin-top:50px;
  border-radius: 5px;
  color: #fbf6dc;
  font-size: 1rem;
}
#timeline p {
  padding: 1rem 0.1rem 1rem;
  margin-left: 15px;
  color: #de3163;
}
#timeline button {
  margin: 0.3rem 0rem 1rem 1rem;
  outline: none;
  border: 2px solid #ddd;
  padding: 0.5rem 1rem;
  border-radius: 50px;
  transition: all 0.5s ease-in;
  font-family: inherit;
  cursor: pointer;
  color:   #de3163;
}
#timeline button:hover {
  background-color: pink;
}
#timeline ul li:nth-child(odd) .box {
  left: 50px;
}
#timeline ul li:nth-child(even) .box {
  left: -500px;
}
#timeline ul li i {
  position: absolute;
  left: 50%;
  top: 20;
  width: 45px;
  height: 45px;
  background-color: #de3163;
  transform: translateX(-50%);
  border-radius: 50%;
}
#timeline .heading{
  margin-top:200px;
}

#timeline ul li:nth-child(odd) .box:before {
  left: -15px;
  border-width: 8px 16px 8px 0;
  border-color: transparent #de3163;
}
#timeline ul li:nth-child(even) .box:before {
  right: -15px;
  border-width: 8px 0px 8px 16px;
  border-color: transparent #de3163;
}

/* Popup styles */
.hidden {
  display: none;
}
.image-popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}
.popup-content {
  position: relative;
  text-align: center;
}
#popup-image {
  max-width: 90%;
  max-height: 90vh;
  object-fit: contain;
}
.close {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 40px;
  color: white;
  cursor: pointer;
}
.nav-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  font-size: 40px;
  cursor: pointer;
  padding: 10px;
  z-index: 10000;
}
#prev-image {
  left: 20px;
}
#next-image {
  right: 20px;
}
/* Media queries của bạn ... */
@media (max-width: 900px) {
  #timeline ul li .box {
    width: 350px;
  }
  #timeline ul li:nth-child(even) .box:before {
    left: -15px;
    border-width: 8px 16px 8px 0;
    border-color: transparent #de3163;
  }
  #timeline ul li:nth-child(odd) .box:before {
    left: 40px;
  }
  #timeline ul li:nth-child(odd) .box {
    left: 40px;
  }
  #timeline ul li:nth-child(even) .box {
    left: -390px;
  }
}
@media (max-width: 768px) {
  #timeline ul li {
    margin-left: 30px;
  }
  #timeline ul li .box {
    width: calc(100vw - 90px);
  }
  #timeline ul li:nth-child(even) .box {
    left: 40px;
  }
  #timeline ul li:nth-child(even) .box:before {
    left: -15px;
    border-width: 8px 16px 8px 0;
    border-color: transparent #de3163;
  }
}
    </style>
  <section id="timeline">
    <h2 class="heading" style="margin-top:200px;">Our History</h2>
    <ul style="list-style: none; padding: 0;">
      <?php
      $timeline = [
        [
          "year" => "1969",
          "title" => "A Small Local Restaurant",
          "desc" => "After AT&T had dropped out of the Multics project, the Restaurant founded and runned by Ken Thompson and Dennis Ritchie (both of AT&T Bell Laboratories) in 1969.",
          "gallery" => [
            "../PicAndVid/img/Ken_Thompson_and_Dennis_Ritchie--1973.jpg",
            "../PicAndVid/img/images23.jpg"
          ]
        ],
        [
          "year" => "1976",
          "title" => "The Second Restaurant",
          "desc" => "KFC popularized chicken in the fast-food industry, diversifying the market by challenging the established dominance of the hamburger.",
          "gallery" => [
            "../PicAndVid/img/bc3e85c39bb0412d9f4d8c243dceb58b.jpg",
            "../PicAndVid/img/Arthur-Treachers-Fish-and-Chips-vintage-fast-food-restaurants-2.jpg"
          ]
        ],
        [
          "year" => "1990",
          "title" => "Fitty Eaty",
          "desc" => "KFC was one of the first American fast-food chains to expand internationally, opening outlets in Canada, the UK, Mexico and Jamaica by the mid-1960s.",
          "gallery" => [
            "../PicAndVid/img/1740664736_2728687.webp"
          ]
        ],
        [
          "year" => "2000",
          "title" => "The First Guinness",
          "desc" => "Our Restaurant was given 1 Guinness for making over 100 billion meals for people over the world.",
          "gallery" => [
            "../PicAndVid/img/images11.jpg",
            "../PicAndVid/img/images11.jpg",
            "../PicAndVid/img/ima21ges.jpg"
          ]
        ],
        [
          "year" => "2012",
          "title" => "Big Collaborations",
          "desc" => "Los Angeles-based SANDALBOYZ collaborated with KFC Indonesia on a collection of sandals and apparel.",
          "gallery" => [
            "../PicAndVid/img/down.jpg"
          ]
        ],
        [
          "year" => "2025",
          "title" => "New Adventure",
          "desc" => "We will change our menu daily and weekend discounts will be cheaper with shocking prices.",
          "gallery" => [
            "../PicAndVid/img/new_adventure.jpg"
          ]
        ]
      ];

      foreach ($timeline as $index => $item): ?>
        <li>
          <i class="fa-brands fa-css3"></i>
          <div class="box container">
            <h3 class="title">
              <span class="year"><?= htmlspecialchars($item['year']) ?></span> <?= htmlspecialchars($item['title']) ?>
            </h3>
            <p><?= htmlspecialchars($item['desc']) ?></p>
            <button class="btn btn-primary showGallery" data-target="gallery<?= $index + 1 ?>">Read more</button>
            <div id="gallery<?= $index + 1 ?>" class="gallery" style="display: none;">
              <?php foreach ($item['gallery'] as $img): ?>
                <a href="<?= htmlspecialchars($img) ?>" data-lightbox="gallery<?= $index + 1 ?>">
                  <img src="<?= htmlspecialchars($img) ?>" width="100">
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
</main>
<?php
include_once '../phpFile/footer.php';
?>

<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script>
  // Scroll animation
  const boxes = document.querySelectorAll(".box");
  window.addEventListener("scroll", DisplayContent);
  function DisplayContent() {
    const TriggerBottom = (window.innerHeight / 5) * 4;
    boxes.forEach((box) => {
      const topBox = box.getBoundingClientRect().top;
      if (topBox < TriggerBottom) {
        box.classList.add("show");
      } else {
        box.classList.remove("show");
      }
    });
  }

  // Show gallery on button click
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.showGallery').forEach(button => {
      button.addEventListener('click', () => {
        const target = button.getAttribute('data-target');
        const gallery = document.getElementById(target);
        gallery.style.display = gallery.style.display === 'block' ? 'none' : 'block';
      });
    });

    // Lightbox
    const lightbox = GLightbox();
  });
</script>