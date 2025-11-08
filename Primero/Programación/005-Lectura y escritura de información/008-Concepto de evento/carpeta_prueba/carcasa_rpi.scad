// Modelo de pieza para Raspberry Pi 4
// Carcasa inferior

module base() {
    cube([85, 56, 10]);
}

module agujeros_tornillos() {
    translate([3.5, 3.5, 0]) cylinder(h=10, r=1.5);
    translate([3.5, 52.5, 0]) cylinder(h=10, r=1.5);
    translate([81.5, 3.5, 0]) cylinder(h=10, r=1.5);
    translate([81.5, 52.5, 0]) cylinder(h=10, r=1.5);
}

difference() {
    base();
    agujeros_tornillos();
}
