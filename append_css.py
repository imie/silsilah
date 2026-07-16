css = """
/* Ancestor Tree Structure (Mirrored leftward) */
.ancestor-branch {
    position: relative;
    margin-right: 280px; 
}

.ancestor-branch:before {
    content: "";
    width: 40px;
    border-top: 2px solid #cbd5e1;
    position: absolute;
    right: -80px;
    top: 50%;
    margin-top: -1px;
}

.ancestor-entry {
    position: relative;
    min-height: 80px; 
    display: flex;
    align-items: center;
    padding: 10px 0;
    justify-content: flex-end; /* cards align right */
}

/* Vertical Line connecting siblings */
.ancestor-entry:before {
    content: "";
    height: 100%;
    border-right: 2px solid #cbd5e1;
    position: absolute;
    right: -40px;
}

/* Horizontal Line to this specific child */
.ancestor-entry:after {
    content: "";
    width: 40px;
    border-top: 2px solid #cbd5e1;
    position: absolute;
    right: -40px;
    top: 50%;
    margin-top: -1px;
}

/* Top-most rounded corner */
.ancestor-entry:first-child:before {
    width: 15px;
    height: 50%;
    top: 50%;
    margin-top: 1px;
    border-radius: 0 12px 0 0;
}
.ancestor-entry:first-child:after {
    height: 15px;
    border-radius: 0 12px 0 0;
}

/* Bottom-most rounded corner */
.ancestor-entry:last-child:before {
    width: 15px;
    height: 50%;
    border-radius: 0 0 12px 0;
}
.ancestor-entry:last-child:after {
    height: 15px;
    border-top: none;
    border-bottom: 2px solid #cbd5e1;
    border-radius: 0 0 12px 0;
    margin-top: -16px;
}

/* Sole child */
.ancestor-entry.sole:before {
    display: none;
}
.ancestor-entry.sole:after {
    width: 40px;
    height: 0;
    margin-top: -1px;
    border-radius: 0;
}

/* Override absolute positioning for ancestor nodes */
.ancestor-entry .tree-card {
    position: absolute;
    left: auto;
    right: 0;
}
"""

with open('public/css/tree.css', 'a') as f:
    f.write("\n" + css)
