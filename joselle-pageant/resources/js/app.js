import "./bootstrap";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Parallax from "parallax-js";

gsap.registerPlugin(ScrollTrigger);

window.gsap = gsap;
window.Parallax = Parallax;
window.ScrollTrigger = ScrollTrigger;
