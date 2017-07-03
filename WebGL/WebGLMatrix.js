// Matrix and vector manipulation functions.  The order is suitable for passing
// the matrices to an OpenGL shader.  All methods create a new matrix or vector.

// Figure out what is supported on this platform.
glMatrixArrayType=
    typeof Float32Array != "undefined" ? Float32Array :
        typeof WebGLFloatArray != "undefined" ? WebGLFloatArray : Array;



// Matrix2x2
// =========

function Matrix2x2()
{
    var m = new glMatrixArrayType(4);

    m[ 0]=1;    m[ 2]=0;
    m[ 1]=0;    m[ 3]=1;

    return m;
}

function Rotate2x2(angleDeg)
{
    angleRad = angleDeg * Math.PI / 180;

    var m = new glMatrixArrayType(4);

    m[ 0]=  Math.cos(angleRad);    m[ 2]= Math.sin(angleRad);
    m[ 1]= -Math.sin(angleRad);    m[ 3]= Math.cos(angleRad);
 
    return m;
}

function Scale2x2(sx, sy)
{
    var m = new glMatrixArrayType(4);

    m[ 0]=sx;   m[ 2]=0;
    m[ 1]=0;    m[ 3]=sy;

    return m;
}

function Multiply2x2_2x2(A, B)
{
    var m = new glMatrixArrayType(4);

    m[0] = A[0]*B[0] + A[2]*B[1];
    m[1] = A[1]*B[0] + A[3]*B[1];
    m[2] = A[0]*B[2] + A[2]*B[3];
    m[3] = A[1]*B[2] + A[3]*B[3];

    return m;    
}



// Matrix3x3
// =========

function Matrix3x3()
{
    var m = new glMatrixArrayType(9);

    m[ 0]=1;    m[ 3]=0;    m[ 6]=0;
    m[ 1]=0;    m[ 4]=1;    m[ 7]=0;
    m[ 2]=0;    m[ 5]=0;    m[ 8]=1;

    return m;
}

function Rotate3x3(angleDeg)
{
    angleRad = angleDeg * Math.PI / 180;

    var m = new glMatrixArrayType(9);

    m[ 0]=  Math.cos(angleRad);    m[ 3]= Math.sin(angleRad);   m[ 6]=0;
    m[ 1]= -Math.sin(angleRad);    m[ 4]= Math.cos(angleRad);   m[ 7]=0;
    m[ 2]=                   0;    m[ 5]=                  0;   m[ 8]=1;

    return m;
}

function Translate3x3(tx, ty)
{
    var m = new glMatrixArrayType(9);

    m[ 0]=0;    m[ 3]=0;    m[ 6]=tx;
    m[ 1]=0;    m[ 4]=0;    m[ 7]=ty;
    m[ 2]=0;    m[ 5]=0;    m[ 8]=1;

    return m;
}

function Scale3x3(sx, xy)
{
    var m = new glMatrixArrayType(9);

    m[ 0]=sx;   m[ 3]=0;    m[ 6]=0;
    m[ 1]=0;    m[ 4]=sy;   m[ 7]=0;
    m[ 2]=0;    m[ 5]=0;    m[ 8]=1;

    return m;
}

// Geometric Hierarchy of 2D to 2D plane transformations.

// The following "build up" to projective/homography.  They are comprised
// of rotations, translations, isotropic scaling,

// 1) Isometry preserves Euclidean distance, three degrees of freedom.
function Isometry3x3(angleDeg, tx, ty)
{
    angleRad = angleDeg * Math.PI / 180;

    var m = new glMatrixArrayType(9);

    m[ 0]=  Math.cos(angleRad);    m[ 3]= Math.sin(angleRad);   m[ 6]=tx;
    m[ 1]= -Math.sin(angleRad);    m[ 4]= Math.cos(angleRad);   m[ 7]=ty;
    m[ 2]=                   0;    m[ 5]=                  0;   m[ 8]=1;

    return m;
}

// 2) Similarity preserves angles and ratios of distances, but not distances.
//    Adds a fourth degree of freedom, an isotropic scale factor.
function Similarity3x3(angleDeg, tx, ty, s)
{
    angleRad = angleDeg * Math.PI / 180;

    var m = new glMatrixArrayType(9);

    m[ 0]=  s*Math.cos(angleRad);   m[ 3]=s*Math.sin(angleRad);  m[ 6]=tx;
    m[ 1]= -s*Math.sin(angleRad);   m[ 4]=s*Math.cos(angleRad);  m[ 7]=ty;
    m[ 2]=                     0;   m[ 5]=                   0;  m[ 8]=1;

    return m;
}

// 3) Affine does not preserve angles or ratios of distances, but does preserve
//    ratios of lengths and parallel lines remain parallel.  Has six degrees
//    of freedom.
function Affine3x3(thetaDeg, phiDeg, tx, ty, sx, sy)
{
    thetaRad = thetaDeg * Math.PI / 180;
    phiRad   = phiDeg   * Math.PI / 180;

    var m = new glMatrixArrayType(9);

    // Compute an A matrix which is decomposed as follows:
    A0 = Rotate2x2(thetaDeg);
    A1 = Rotate2x2(-phiDeg);
    A2 = Scale2x2(sx, xy);
    A3 = Rotate2x2(phiDeg);
    
    A4 = Multiply2x2_2x2(A0, A1);
    A5 = Multiply2x2_2x2(A4, A2);

    A  = Multiply2x2_2x2(A5, A3);

    m[ 0]=A[0];     m[ 3]=A[2];     m[ 6]=tx;
    m[ 1]=A[1];     m[ 4]=A[3];     m[ 7]=ty;
    m[ 2]=0;        m[ 5]=0;        m[ 8]=1;

    return m;
}

// 4) Projective transforms are homographies.  Preserves colinearity of
//    three points.  The bottom row is not [0 0 1].  Typically, as in the
//    case of image stitching, corresponding points of two images are known
//    and the elements of the Projective/Homography are solved for.
function Projection3x3(thetaDeg, phiDeg, tx, ty, sx, sy, v1, v2)
{
    thetaRad = thetaDeg * Math.PI / 180;
    phiRad   = phiDeg   * Math.PI / 180;

    var m = new glMatrixArrayType(9);

    // Compute an A matrix which is decomposed as follows:
    A0 = Rotate2x2(thetaDeg);
    A1 = Rotate2x2(-phiDeg);
    A2 = Scale2x2(sx, sy);
    A3 = Rotate2x2(phiDeg);
    
    A4 = Multiply2x2_2x2(A0, A1);
    A5 = Multiply2x2_2x2(A4, A2);

    A  = Multiply2x2_2x2(A5, A3);

    m[ 0]=A[0];     m[ 3]=A[2];     m[ 6]=tx;
    m[ 1]=A[1];     m[ 4]=A[3];     m[ 7]=ty;
    m[ 2]=v1;       m[ 5]=v2;       m[ 8]=1;

    return m;
}




function Multiply3x3_3x3(A, B)
{
    var m = new glMatrixArrayType(9);

    m[0] = A[0]*B[0] + A[3]*B[1] + A[6]*B[2];
    m[1] = A[1]*B[0] + A[4]*B[1] + A[7]*B[2];
    m[2] = A[2]*B[0] + A[5]*B[1] + A[8]*B[2];

    m[3] = A[0]*B[3] + A[3]*B[4] + A[6]*B[5];
    m[4] = A[1]*B[3] + A[4]*B[4] + A[7]*B[5];
    m[5] = A[2]*B[3] + A[5]*B[4] + A[8]*B[5];

    m[6] = A[0]*B[6] + A[3]*B[7] + A[6]*B[8];
    m[7] = A[1]*B[6] + A[4]*B[7] + A[7]*B[8];
    m[8] = A[2]*B[6] + A[5]*B[7] + A[8]*B[8];

    return m;    
}



// Matrix4x4
// =========

function Matrix4x4()
{
    var m = new glMatrixArrayType(16);

    m[ 0]=1;    m[ 4]=0;    m[ 8]=0;    m[12]=0;
    m[ 1]=0;    m[ 5]=1;    m[ 9]=0;    m[13]=0;
    m[ 2]=0;    m[ 6]=0;    m[10]=1;    m[14]=0;
    m[ 3]=0;    m[ 7]=0;    m[11]=0;    m[15]=1;

    return m
}

function RotateX4x4(angleDeg)
{
    angleRad = angleDeg * Math.PI / 180;

    var m = new glMatrixArrayType(16);

    m[ 0]=1;   m[ 4]=                  0;      m[ 8]=                  0;    m[12]=0;
    m[ 1]=0;   m[ 5]= Math.cos(angleRad);      m[ 9]= Math.sin(angleRad);    m[13]=0;
    m[ 2]=0;   m[ 6]=-Math.sin(angleRad);      m[10]= Math.cos(angleRad);    m[14]=0;
    m[ 3]=0;   m[ 7]=                  0;      m[11]=                  0;    m[15]=1;
 
    return m;
}

function RotateY4x4(angleDeg)
{
    angleRad = angleDeg * Math.PI / 180;

    var m = new glMatrixArrayType(16);

    m[ 0]= Math.cos(angleRad);   m[ 4]=0;      m[ 8]= Math.sin(angleRad);    m[12]=0;
    m[ 1]=                  0;   m[ 5]=1;      m[ 9]=                  0;    m[13]=0;
    m[ 2]=-Math.sin(angleRad);   m[ 6]=0;      m[10]= Math.cos(angleRad);    m[14]=0;
    m[ 3]=                  0;   m[ 7]=0;      m[11]=                  0;    m[15]=1;
 
    return m;
}

function RotateZ4x4(angleDeg)
{
    angleRad = angleDeg * Math.PI / 180;

    var m = new glMatrixArrayType(16);

    m[ 0]=  Math.cos(angleRad);     m[ 4]= Math.sin(angleRad);      m[ 8]=0;    m[12]=0;
    m[ 1]= -Math.sin(angleRad);     m[ 5]= Math.cos(angleRad);      m[ 9]=0;    m[13]=0;
    m[ 2]=                   0;     m[ 6]=                  0;      m[10]=1;    m[14]=0;
    m[ 3]=                   0;     m[ 7]=                  0;      m[11]=0;    m[15]=1;
 
    return m;
}

function Rotate4x4(angleXDeg, angleYDeg, angleZDeg)
{
    var rotateX = RotateX4x4(angleXDeg);
    var rotateY = RotateY4x4(angleYDeg);
    var rotateZ = RotateZ4x4(angleZDeg);
    
    var R1 = Multiply4x4_4x4(rotateX, rotateY);
    var R2 = Multiply4x4_4x4(R1, rotateZ);
    
    return R2;
}

// http://en.wikipedia.org/wiki/Rotation_matrix
function Rodrigues4x4(nX, nY, nZ, angleDeg)
{
    var nMag = Math.sqrt(nX*nX + nY*nY + nZ*nZ);
    
    nX = nX / nMag;
    nY = nY / nMag;
    nZ = nZ / nMag;

    var angleRad = angleDeg * Math.PI / 180;
    var cos = Math.cos(angleRad);
    var sin = Math.sin(angleRad);
    
    var m = new glMatrixArrayType(16);

    m[ 0] = cos + nX*nX*(1 - cos);      m[ 4] = nX*nY*(1 - cos) - nZ*sin;       m[ 8] = nX*nZ*(1 - cos) + nY*sin;       m[12] = 0.0;
    m[ 1] = nY*nX*(1 - cos) + nZ*sin;   m[ 5] = cos + nY*nY*(1 - cos);          m[ 9] = nY*nZ*(1 - cos) - nX*sin;       m[13] = 0.0;
    m[ 2] = nZ*nX*(1 - cos) - nY*sin;   m[ 6] = nZ*nY*(1 - cos) + nX*sin;       m[10] = cos + nZ*nZ*(1 - cos);          m[14] = 0.0;
    m[ 3] = 0;                          m[ 7] = 0;                              m[11] = 0;                              m[15] = 1;
    
    return m
}

function Translate4x4(tx, ty, tz)
{
    var m = new glMatrixArrayType(16);

    m[ 0]=1;    m[ 4]=0;    m[ 8]=0;    m[12]=tx;
    m[ 1]=0;    m[ 5]=1;    m[ 9]=0;    m[13]=ty;
    m[ 2]=0;    m[ 6]=0;    m[10]=1;    m[14]=tz;
    m[ 3]=0;    m[ 7]=0;    m[11]=0;    m[15]=1;

    return m
}

function Scale4x4(sx, sy, sz)
{
    var m = new glMatrixArrayType(16);

    m[ 0]=sx;   m[ 4]=0;    m[ 8]=0;    m[12]=0;
    m[ 1]=0;    m[ 5]=sy;   m[ 9]=0;    m[13]=0;
    m[ 2]=0;    m[ 6]=0;    m[10]=sz;   m[14]=0;
    m[ 3]=0;    m[ 7]=0;    m[11]=0;    m[15]=1;

    return m
}

// Projection is really 3x3, but make a 4x4 for OpenGL
function Projection4x4(thetaDeg, phiDeg, tx, ty, sx, sy, v1, v2)
{
    var m = new glMatrixArrayType(16);

    var p = Projection3x3(thetaDeg, phiDeg, tx, ty, sx, sy, v1, v2);

    m[ 0]=p[0];     m[ 4]=p[3];     m[ 8]=p[6];     m[12]=0;
    m[ 1]=p[1];     m[ 5]=p[4];     m[ 9]=p[7];     m[13]=0;
    m[ 2]=p[2];     m[ 6]=p[5];     m[10]=p[8];     m[14]=0;
    m[ 3]=0;        m[ 7]=0;        m[11]=0;        m[15]=1;

    return m;
}



// Perspective (4x4)
// -----------------

// Use Frustrum4x4() and Perspective4x4() to generate a perspective matrix.
// Left, right, bottom, top, near, far.
function Frustum4x4(l,r,b,t,n,f)
{
    var m = new glMatrixArrayType(16);

    m[0]=n*2/(r-l);
    m[1]=0;
    m[2]=0;
    m[3]=0;

    m[4]=0;
    m[5]=n*2/(t-b);
    m[6]=0;
    m[7]=0;

    m[8]=(r+l)/(r-l); // With l = -r, this is 0.
    m[9]=(t+b)/(t-b); // With b = -t, this is 0.
    m[10]=-(f+n)/(f-n);
    m[11]=-1;

    m[12]=0;
    m[13]=0;
    m[14]=-(f*n*2)/(f-n);
    m[15]=0;

    return m;
};

// Field of view, aspect ratio, near, far.
function Perspective4x4(fov,asp,n,f)
{
    console.log(fov + " " + asp + " " + n + " " + f);
    var bt=n*Math.tan(fov*Math.PI/360);
    var lr=bt*asp;    

    var l=-lr;
    var r=+lr;
    var b=-bt;
    var t=+bt;

    var m = new glMatrixArrayType(16);

    m[0]=n*2/(r-l);
    m[1]=0;
    m[2]=0;
    m[3]=0;

    m[4]=0;
    m[5]=n*2/(t-b);
    m[6]=0;
    m[7]=0;

    m[8]=(r+l)/(r-l); // With l = -r, this is 0.
    m[9]=(t+b)/(t-b); // With b = -t, this is 0.
    m[10]=-(f+n)/(f-n);
    m[11]=-1;

    m[12]=0;
    m[13]=0;
    m[14]=-(f*n*2)/(f-n);
    m[15]=0;
    
    return m;
};


// Field of view, aspect ratio, near, far.
function Orthographic4x4(fov,asp,n,f)
{
    console.log(fov + " " + asp + " " + n + " " + f);
    var bt=n*Math.tan(fov*Math.PI/360);
    var lr=bt*asp;

    var l=-lr;
    var r=+lr;
    var b=-bt;
    var t=+bt;

    var m = new glMatrixArrayType(16);

    m[0]=2/(r-l);
    m[1]=0;
    m[2]=0;
    m[3]=0;

    m[4]=0;
    m[5]=2/(t-b);
    m[6]=0;
    m[7]=0;

    m[8]=0;
    m[9]=0;
    m[10]=-2/(f-n);
    m[11]=0;

    m[12]=-(r+l)/(r-l);
    m[13]=-(t+b)/(t-b);
    m[14]=-(f+n)/(f-n);
    m[15]=1;

    return m;
};


function Multiply4x4_4x4(A, B)
{
    var m = new glMatrixArrayType(16);

    m[ 0] = A[ 0]*B[ 0] + A[ 4]*B[ 1] + A[ 8]*B[ 2] + A[12]*B[ 3];
    m[ 1] = A[ 1]*B[ 0] + A[ 5]*B[ 1] + A[ 9]*B[ 2] + A[13]*B[ 3];
    m[ 2] = A[ 2]*B[ 0] + A[ 6]*B[ 1] + A[10]*B[ 2] + A[14]*B[ 3];
    m[ 3] = A[ 3]*B[ 0] + A[ 7]*B[ 1] + A[11]*B[ 2] + A[15]*B[ 3];

    m[ 4] = A[ 0]*B[ 4] + A[ 4]*B[ 5] + A[ 8]*B[ 6] + A[12]*B[ 7];
    m[ 5] = A[ 1]*B[ 4] + A[ 5]*B[ 5] + A[ 9]*B[ 6] + A[13]*B[ 7];
    m[ 6] = A[ 2]*B[ 4] + A[ 6]*B[ 5] + A[10]*B[ 6] + A[14]*B[ 7];
    m[ 7] = A[ 3]*B[ 4] + A[ 7]*B[ 5] + A[11]*B[ 6] + A[15]*B[ 7];

    m[ 8] = A[ 0]*B[ 8] + A[ 4]*B[ 9] + A[ 8]*B[10] + A[12]*B[11];
    m[ 9] = A[ 1]*B[ 8] + A[ 5]*B[ 9] + A[ 9]*B[10] + A[13]*B[11];
    m[10] = A[ 2]*B[ 8] + A[ 6]*B[ 9] + A[10]*B[10] + A[14]*B[11];
    m[11] = A[ 3]*B[ 8] + A[ 7]*B[ 9] + A[11]*B[10] + A[15]*B[11];

    m[12] = A[ 0]*B[12] + A[ 4]*B[13] + A[ 8]*B[14] + A[12]*B[15];
    m[13] = A[ 1]*B[12] + A[ 5]*B[13] + A[ 9]*B[14] + A[13]*B[15];
    m[14] = A[ 2]*B[12] + A[ 6]*B[13] + A[10]*B[14] + A[14]*B[15];
    m[15] = A[ 3]*B[12] + A[ 7]*B[13] + A[11]*B[14] + A[15]*B[15];
    
    console.log(m[0] + " " + m[4] + " " + m[ 8] + " " + m[12]);
    console.log(m[1] + " " + m[5] + " " + m[ 9] + " " + m[13]);
    console.log(m[2] + " " + m[6] + " " + m[10] + " " + m[14]);
    console.log(m[3] + " " + m[7] + " " + m[11] + " " + m[15]);
    console.log();

    return m;
}
