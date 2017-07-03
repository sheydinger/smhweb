
// Shader Program
// ==============

// Tools to load shaders and compile a program, and cleanup.

var fragmentShader;
var vertexShader;

var shaderProgram;

function getShader(gl, id) {
    var shaderScript = document.getElementById(id);
    if (!shaderScript) {
        return null;
    }

    // Put the contents of the script shader tags into the "str" variable.
    var str = "";
    var k = shaderScript.firstChild;
    while (k) {
        if (k.nodeType == 3) {
            str += k.textContent;
        }
        k = k.nextSibling;
    }
    console.log("str=" + str);

    var shader;
    if (shaderScript.type == "x-shader/x-fragment") {
        shader = gl.createShader(gl.FRAGMENT_SHADER);
    } else if (shaderScript.type == "x-shader/x-vertex") {
        shader = gl.createShader(gl.VERTEX_SHADER);
    } else {
        return null;
    }
    console.log("shader=" + shader);

    gl.shaderSource(shader, str);
    gl.compileShader(shader);

    if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
        alert(gl.getShaderInfoLog(shader));
        return null;
    }

    return shader;
}

function loadShaderProgram(gl)
{
    fragmentShader = getShader(gl, "shader-fs");
    vertexShader = getShader(gl, "shader-vs");

    shaderProgram = gl.createProgram();
    gl.attachShader(shaderProgram, vertexShader);
    gl.attachShader(shaderProgram, fragmentShader);
    gl.linkProgram(shaderProgram);

    if (!gl.getProgramParameter(shaderProgram, gl.LINK_STATUS)) {
        alert("Could not initialise shaders");
    }

    return shaderProgram;
}

function loadShaderProgramById(gl, vertexID, fragmentID)
{
    vertexShader   = getShader(gl, vertexID);
    fragmentShader = getShader(gl, fragmentID);

    shaderProgram = gl.createProgram();
    gl.attachShader(shaderProgram, vertexShader);
    gl.attachShader(shaderProgram, fragmentShader);
    gl.linkProgram(shaderProgram);

    if (!gl.getProgramParameter(shaderProgram, gl.LINK_STATUS)) {
        alert("Could not initialise shaders");
    }

    return shaderProgram;
}

function removeShaderProgram(gl)
{
    gl.deleteShader(vertexShader);
    gl.deleteShader(fragmentShader);
    gl.deleteProgram(shaderProgram);
}


// Show Colors
// ===========

// Show colors on the screen based on mouse location.  This requires
// the following in the HTML file:

//    <p id="colorCoordinates">&nbsp;</p>
//    <div id="colorDemo" style="width:50px; height:50px;"></div>

// and is invoked by adding the following to the <canvas> tag:

//    onmouseover="showColor(event);" onmouseout="clearColor(event);" onmousemove="showColor(event);

// Also need to save the drawing buffer:
//        gl = canvas.getContext("experimental-webgl",
//            {
//                preserveDrawingBuffer: true,
//                antialias: false
//            });

function showColor(e)
{
    // Find the location of the canvas in the client.  Mouse coordinates
    // are with respect to the client, not the canvas object.
    var rect = document.getElementById("myCanvas").getBoundingClientRect();

    // The origin for e.client? is the upper left, but the readPixels() origin
    // is the gl Context bottom.  Therefore, we need to vertically flip the Y position.
    var X = Math.floor(e.clientX - rect.left);
    var Y = Math.floor((rect.height-1) - (e.clientY - rect.top));

    // Read a 1x1 pixel area
    var pixels = new Uint8Array(4);
    gl.readPixels(X, Y, 1, 1, gl.RGBA, gl.UNSIGNED_BYTE, pixels);

    // Show the pixel coordinates and color on the screen.
    var stringMessage = "rgb(" + pixels[0] + "," + pixels[1] + "," + pixels[2] + ") @ (" + X + "," + Y + ")";
    var stringColor = "rgb(" + pixels[0] + "," + pixels[1] + "," + pixels[2] + ")";

    document.getElementById("colorCoordinates").innerHTML = stringMessage;
    document.getElementById("colorDemo").style.background=stringColor;
    document.getElementById("colorDemo").style.border="solid 1px black";
}
    
function clearColor(e)
{
    document.getElementById("colorCoordinates").innerHTML = "&nbsp;";
    document.getElementById("colorDemo").style.background="rgb(255,255,255)";
    document.getElementById("colorDemo").style.border="";
}
