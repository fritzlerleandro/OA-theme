<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oficina Ambulante - Arquitectura & Mobiliario</title>
    <style>
        html {
  margin: 0;
  padding: 0;
  height: 100%;
}

body {
  margin: 0;
  padding: 0;
  height: 100%;
  max-height: 100%;
  float: left;
  width: 100%;
}
figure {
  display: block;
  margin-block-start: 0;
  margin-block-end: 0;
  margin-inline-start: 0;
  margin-inline-end: 0;
  margin: 0 0;
}

.crossfade > figure {
  animation: imageAnimation 30s linear infinite 0s;
  backface-visibility: hidden;
  background-size: cover;
  background-position: center center;
  color: transparent;
  height: 100%;
  left: 0px;
  opacity: 0;
  position: absolute;
  top: 0px;
  width: 100%;
  z-index: 0;
}

.crossfade > figure:nth-child(1) {
  background-image: url("<?php the_field('imagen_1') ?>");
}
.crossfade > figure:nth-child(2) {
  animation-delay: 6s;
  background-image: url("<?php the_field('imagen_2') ?>");
}
.crossfade > figure:nth-child(3) {
  animation-delay: 12s;
  background-image: url("<?php the_field('imagen_3') ?>");
}
.crossfade > figure:nth-child(4) {
  animation-delay: 18s;
  background-image: url("<?php the_field('imagen_4') ?>");
}
.crossfade > figure:nth-child(5) {
  animation-delay: 24s;
  background-image: url("<?php the_field('imagen_5') ?>");
}

@keyframes imageAnimation {
  0% {
    animation-timing-function: ease-in;
    opacity: 0;
  }
  8% {
    animation-timing-function: ease-out;
    opacity: 1;
  }
  17% {
    opacity: 1;
  }
  25% {
    opacity: 0;
  }
  100% {
    opacity: 0;
  }
}

    </style>
    <?php wp_head();?>
</head>

<body <?php body_class('test');?>>