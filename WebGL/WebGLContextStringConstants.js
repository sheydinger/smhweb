// From http://www.khronos.org/registry/webgl/specs/latest/1.0/#5.14

function BooleanToString(which)
{
    // Rather than just print using .toString() on a boolean value, do
    // this function since the boolean variable may be null, i.e., need
    // the ? default case!
    switch (which)
    {
        case true:      return "true";
        case false:     return "false";
        default:        return "?";
    }
}

// The value '0' has multiple meanings, one is NO_ERROR.  If we know
// we're looking for an error do use ErrorToString() to get the right
// 0 string.
function ErrorToString(which)
{
    switch (which)
    {
        /* ErrorCode */
        case gl.NO_ERROR:                                       return "gl.NO_ERROR";
        case gl.INVALID_ENUM:                                   return "gl.INVALID_ENUM";
        case gl.INVALID_VALUE:                                  return "gl.INVALID_VALUE";
        case gl.INVALID_OPERATION:                              return "gl.INVALID_OPERATION";
        case gl.OUT_OF_MEMORY:                                  return "gl.OUT_OF_MEMORY";
    }
}

function ConstantToString(which)
{
    switch (which)
    {
        /* ClearBufferMask */
        case gl.DEPTH_BUFFER_BIT:                               return "gl.DEPTH_BUFFER_BIT";
        case gl.STENCIL_BUFFER_BIT:                             return "gl.STENCIL_BUFFER_BIT";
        case gl.COLOR_BUFFER_BIT:                               return "gl.COLOR_BUFFER_BIT";

        /* BeginMode */
        case gl.POINTS:                                         return "gl.POINTS";
        case gl.LINES:                                          return "gl.LINES";
        case gl.LINE_LOOP:                                      return "gl.LINE_LOOP";
        case gl.LINE_STRIP:                                     return "gl.LINE_STRIP";
        case gl.TRIANGLES:                                      return "gl.TRIANGLES";
        case gl.TRIANGLE_STRIP:                                 return "gl.TRIANGLE_STRIP";
        case gl.TRIANGLE_FAN:                                   return "gl.TRIANGLE_FAN";

        /* AlphaFunction (not supported in ES20) */
        /*      NEVER */
        /*      LESS */
        /*      EQUAL */
        /*      LEQUAL */
        /*      GREATER */
        /*      NOTEQUAL */
        /*      GEQUAL */
        /*      ALWAYS */

        /* BlendingFactorDest */
        case gl.ZERO:                                           return "gl.ZERO";
        case gl.ONE:                                            return "gl.ONE";
        case gl.SRC_COLOR:                                      return "gl.SRC_COLOR";
        case gl.ONE_MINUS_SRC_COLOR:                            return "gl.ONE_MINUS_SRC_COLOR";
        case gl.SRC_ALPHA:                                      return "gl.SRC_ALPHA";
        case gl.ONE_MINUS_SRC_ALPHA:                            return "gl.ONE_MINUS_SRC_ALPHA";
        case gl.DST_ALPHA:                                      return "gl.DST_ALPHA";
        case gl.ONE_MINUS_DST_ALPHA:                            return "gl.ONE_MINUS_DST_ALPHA";

        /* BlendingFactorSrc */
        /*      ZERO */
        /*      ONE */
        case gl.DST_COLOR:                                      return "gl.DST_COLOR";
        case gl.ONE_MINUS_DST_COLOR:                            return "gl.ONE_MINUS_DST_COLOR";
        case gl.SRC_ALPHA_SATURATE:                             return "gl.";
        /*      SRC_ALPHA */
        /*      ONE_MINUS_SRC_ALPHA */
        /*      DST_ALPHA */
        /*      ONE_MINUS_DST_ALPHA */

        /* BlendEquationSeparate */
        case gl.FUNC_ADD:                                       return "gl.FUNC_ADD";
        case gl.BLEND_EQUATION:                                 return "gl.BLEND_EQUATION";
        case gl.BLEND_EQUATION_RGB:                             return "gl.BLEND_EQUATION_RGB";
        case gl.BLEND_EQUATION_ALPHA:                           return "gl.BLEND_EQUATION_ALPHA";

        /* BlendSubtract */
        case gl.FUNC_SUBTRACT:                                  return "gl.FUNC_SUBTRACT";
        case gl.FUNC_REVERSE_SUBTRACT:                          return "gl.FUNC_REVERSE_SUBTRACT";

        /* Separate Blend Functions */
        case gl.BLEND_DST_RGB:                                  return "gl.BLEND_DST_RGB";
        case gl.BLEND_SRC_RGB:                                  return "gl.BLEND_SRC_RGB";
        case gl.BLEND_DST_ALPHA:                                return "gl.BLEND_DST_ALPHA";
        case gl.BLEND_SRC_ALPHA:                                return "gl.BLEND_SRC_ALPHA";
        case gl.CONSTANT_COLOR:                                 return "gl.CONSTANT_COLOR";
        case gl.ONE_MINUS_CONSTANT_COLOR:                       return "gl.ONE_MINUS_CONSTANT_COLOR";
        case gl.CONSTANT_ALPHA:                                 return "gl.CONSTANT_ALPHA";
        case gl.ONE_MINUS_CONSTANT_ALPHA:                       return "gl.ONE_MINUS_CONSTANT_ALPHA";
        case gl.BLEND_COLOR:                                    return "gl.BLEND_COLOR";

        /* Buffer Objects */
        case gl.ARRAY_BUFFER:                                   return "gl.ARRAY_BUFFER";
        case gl.ELEMENT_ARRAY_BUFFER:                           return "gl.ELEMENT_ARRAY_BUFFER";
        case gl.ARRAY_BUFFER_BINDING:                           return "gl.ARRAY_BUFFER_BINDING";
        case gl.ELEMENT_ARRAY_BUFFER_BINDING:                   return "gl.ELEMENT_ARRAY_BUFFER_BINDING";

        case gl.STREAM_DRAW:                                    return "gl.STREAM_DRAW";
        case gl.STATIC_DRAW:                                    return "gl.STATIC_DRAW";
        case gl.DYNAMIC_DRAW:                                   return "gl.DYNAMIC_DRAW";


        case gl.BUFFER_SIZE:                                    return "gl.BUFFER_SIZE";
        case gl.BUFFER_USAGE:                                   return "gl.BUFFER_USAGE";

        case gl.CURRENT_VERTEX_ATTRIB:                          return "gl.CURRENT_VERTEX_ATTRIB";

        /* CullFaceMode */
        case gl.FRONT:                                          return "gl.FRONT";
        case gl.BACK:                                           return "gl.BACK";
        case gl.FRONT_AND_BACK:                                 return "gl.FRONT_AND_BACK";

        /* DepthFunction */
        /*      NEVER */
        /*      LESS */
        /*      EQUAL */
        /*      LEQUAL */
        /*      GREATER */
        /*      NOTEQUAL */
        /*      GEQUAL */
        /*      ALWAYS */

        /* EnableCap */
        /* TEXTURE_2D */
        case gl.CULL_FACE:                                      return "gl.CULL_FACE";
        case gl.BLEND:                                          return "gl.BLEND";
        case gl.DITHER:                                         return "gl.DITHER";
        case gl.STENCIL_TEST:                                   return "gl.STENCIL_TEST";
        case gl.DEPTH_TEST:                                     return "gl.DEPTH_TEST";
        case gl.SCISSOR_TEST:                                   return "gl.SCISSOR_TEST";
        case gl.POLYGON_OFFSET_FILL:                            return "gl.POLYGON_OFFSET_FILL";
        case gl.SAMPLE_ALPHA_TO_COVERAGE:                       return "gl.SAMPLE_ALPHA_TO_COVERAGE";
        case gl.SAMPLE_COVERAGE:                                return "gl.SAMPLE_COVERAGE";

        /* FrontFaceDirection */
        case gl.CW:                                             return "gl.CW";
        case gl.CCW:                                            return "gl.CCW";

        /* GetPName */
        case gl.LINE_WIDTH:                                     return "gl.LINE_WIDTH";
        case gl.ALIASED_POINT_SIZE_RANGE:                       return "gl.ALIASED_POINT_SIZE_RANGE";
        case gl.ALIASED_LINE_WIDTH_RANGE:                       return "gl.ALIASED_LINE_WIDTH_RANGE";
        case gl.CULL_FACE_MODE:                                 return "gl.CULL_FACE_MODE";
        case gl.FRONT_FACE:                                     return "gl.FRONT_FACE";
        case gl.FRONT_FACE:                                     return "gl.FRONT_FACE";
        case gl.DEPTH_WRITEMASK:                                return "gl.DEPTH_WRITEMASK";
        case gl.DEPTH_CLEAR_VALUE:                              return "gl.DEPTH_CLEAR_VALUE";
        case gl.DEPTH_FUNC:                                     return "gl.DEPTH_FUNC";
        case gl.STENCIL_CLEAR_VALUE:                            return "gl.STENCIL_CLEAR_VALUE";
        case gl.STENCIL_FUNC:                                   return "gl.STENCIL_FUNC";
        case gl.STENCIL_FAIL:                                   return "gl.STENCIL_FAIL";
        case gl.STENCIL_PASS_DEPTH_FAIL:                        return "gl.STENCIL_PASS_DEPTH_FAIL";
        case gl.STENCIL_PASS_DEPTH_PASS:                        return "gl.STENCIL_PASS_DEPTH_PASS";
        case gl.STENCIL_REF:                                    return "gl.STENCIL_REF";
        case gl.STENCIL_VALUE_MASK:                             return "gl.STENCIL_VALUE_MASK";
        case gl.STENCIL_WRITEMASK:                              return "gl.STENCIL_WRITEMASK";
        case gl.STENCIL_BACK_FUNC:                              return "gl.STENCIL_BACK_FUNC";
        case gl.STENCIL_BACK_FAIL:                              return "gl.STENCIL_BACK_FAIL";
        case gl.STENCIL_BACK_PASS_DEPTH_FAIL:                   return "gl.STENCIL_BACK_PASS_DEPTH_FAIL";
        case gl.STENCIL_BACK_PASS_DEPTH_PASS:                   return "gl.STENCIL_BACK_PASS_DEPTH_PASS";
        case gl.STENCIL_BACK_REF:                               return "gl.STENCIL_BACK_REF";
        case gl.STENCIL_BACK_VALUE_MASK:                        return "gl.STENCIL_BACK_VALUE_MASK";
        case gl.STENCIL_BACK_WRITEMASK:                         return "gl.STENCIL_BACK_WRITEMASK";
        case gl.VIEWPORT:                                       return "gl.VIEWPORT";
        case gl.SCISSOR_BOX:                                    return "gl.SCISSOR_BOX";

        /*      SCISSOR_TEST */
        case gl.COLOR_CLEAR_VALUE:                              return "gl.COLOR_CLEAR_VALUE";
        case gl.COLOR_WRITEMASK:                                return "gl.COLOR_WRITEMASK";
        case gl.UNPACK_ALIGNMENT:                               return "gl.UNPACK_ALIGNMENT";
        case gl.PACK_ALIGNMENT:                                 return "gl.PACK_ALIGNMENT";
        case gl.MAX_TEXTURE_SIZE:                               return "gl.MAX_TEXTURE_SIZE";
        case gl.MAX_VIEWPORT_DIMS:                              return "gl.MAX_VIEWPORT_DIMS";
        case gl.SUBPIXEL_BITS:                                  return "gl.SUBPIXEL_BITS";
        case gl.RED_BITS:                                       return "gl.RED_BITS";
        case gl.GREEN_BITS:                                     return "gl.GREEN_BITS";
        case gl.BLUE_BITS:                                      return "gl.BLUE_BITS";
        case gl.ALPHA_BITS:                                     return "gl.ALPHA_BITS";
        case gl.DEPTH_BITS:                                     return "gl.DEPTH_BITS";
        case gl.STENCIL_BITS:                                   return "gl.STENCIL_BITS";
        case gl.POLYGON_OFFSET_UNITS:                           return "gl.POLYGON_OFFSET_UNITS";

        /*      POLYGON_OFFSET_FILL */  
        case gl.POLYGON_OFFSET_FACTOR:                          return "gl.POLYGON_OFFSET_FACTOR";
        case gl.TEXTURE_BINDING_2D:                             return "gl.TEXTURE_BINDING_2D";
        case gl.SAMPLE_BUFFERS:                                 return "gl.SAMPLE_BUFFERS";
        case gl.SAMPLES:                                        return "gl.SAMPLES";
        case gl.SAMPLE_COVERAGE_VALUE:                          return "gl.SAMPLE_COVERAGE_VALUE";
        case gl.SAMPLE_COVERAGE_INVERT:                         return "gl.SAMPLE_COVERAGE_INVERT";

        /* GetTextureParameter */
        /*      TEXTURE_MAG_FILTER */
        /*      TEXTURE_MIN_FILTER */
        /*      TEXTURE_WRAP_S */
        /*      TEXTURE_WRAP_T */

        case gl.COMPRESSED_TEXTURE_FORMATS:                     return "gl.COMPRESSED_TEXTURE_FORMATS";

        /* HintMode */
        case gl.DONT_CARE:                                      return "gl.DONT_CARE";
        case gl.FASTEST:                                        return "gl.FASTEST";
        case gl.NICEST:                                         return "gl.NICEST";

        /* HintTarget */
        case gl.GENERATE_MIPMAP_HINT:                           return "gl.GENERATE_MIPMAP_HINT";

        /* DataType */
        case gl.BYTE:                                           return "gl.BYTE";
        case gl.UNSIGNED_BYTE:                                  return "gl.UNSIGNED_BYTE";
        case gl.SHORT:                                          return "gl.SHORT";
        case gl.UNSIGNED_SHORT:                                 return "gl.UNSIGNED_SHORT";
        case gl.INT:                                            return "gl.INT";
        case gl.UNSIGNED_INT:                                   return "gl.UNSIGNED_INT";
        case gl.FLOAT:                                          return "gl.FLOAT";

        /* PixelFormat */
        case gl.DEPTH_COMPONENT:                                return "gl.DEPTH_COMPONENT";
        case gl.ALPHA:                                          return "gl.ALPHA";
        case gl.RGB:                                            return "gl.RGB";
        case gl.RGBA:                                           return "gl.RGBA";
        case gl.LUMINANCE:                                      return "gl.LUMINANCE";
        case gl.LUMINANCE_ALPHA:                                return "gl.LUMINANCE_ALPHA";

        /* PixelType */
        /*      UNSIGNED_BYTE */    
        case gl.UNSIGNED_SHORT_4_4_4_4:                         return "gl.UNSIGNED_SHORT_4_4_4_4";
        case gl.UNSIGNED_SHORT_5_5_5_1:                         return "gl.UNSIGNED_SHORT_5_5_5_1";
        case gl.UNSIGNED_SHORT_5_6_5:                           return "gl.UNSIGNED_SHORT_5_6_5";

        /* Shaders */
        case gl.FRAGMENT_SHADER:                                return "gl.FRAGMENT_SHADER";
        case gl.VERTEX_SHADER:                                  return "gl.VERTEX_SHADER";
        case gl.MAX_VERTEX_ATTRIBS:                             return "gl.MAX_VERTEX_ATTRIBS";
        case gl.MAX_VERTEX_UNIFORM_VECTORS:                     return "gl.MAX_VERTEX_UNIFORM_VECTORS";
        case gl.MAX_VARYING_VECTORS:                            return "gl.MAX_VARYING_VECTORS";
        case gl.MAX_COMBINED_TEXTURE_IMAGE_UNITS:               return "gl.MAX_COMBINED_TEXTURE_IMAGE_UNITS";
        case gl.MAX_VERTEX_TEXTURE_IMAGE_UNITS:                 return "gl.MAX_VERTEX_TEXTURE_IMAGE_UNITS";
        case gl.MAX_TEXTURE_IMAGE_UNITS:                        return "gl.MAX_TEXTURE_IMAGE_UNITS";
        case gl.MAX_FRAGMENT_UNIFORM_VECTORS:                   return "gl.MAX_FRAGMENT_UNIFORM_VECTORS";
        case gl.SHADER_TYPE:                                    return "gl.SHADER_TYPE";
        case gl.DELETE_STATUS:                                  return "gl.DELETE_STATUS";
        case gl.LINK_STATUS:                                    return "gl.LINK_STATUS";
        case gl.VALIDATE_STATUS:                                return "gl.VALIDATE_STATUS";
        case gl.ATTACHED_SHADERS:                               return "gl.ATTACHED_SHADERS";
        case gl.ACTIVE_UNIFORMS:                                return "gl.ACTIVE_UNIFORMS";
        case gl.ACTIVE_ATTRIBUTES:                              return "gl.ACTIVE_ATTRIBUTES";
        case gl.SHADING_LANGUAGE_VERSION:                       return "gl.SHADING_LANGUAGE_VERSION";
        case gl.CURRENT_PROGRAM:                                return "gl.CURRENT_PROGRAM";

        /* StencilFunction */
        case gl.NEVER:                                          return "gl.NEVER";
        case gl.LESS:                                           return "gl.LESS";
        case gl.EQUAL:                                          return "gl.EQUAL";
        case gl.LEQUAL:                                         return "gl.LEQUAL";
        case gl.GREATER:                                        return "gl.GREATER";
        case gl.NOTEQUAL:                                       return "gl.NOTEQUAL";
        case gl.GEQUAL:                                         return "gl.GEQUAL";
        case gl.ALWAYS:                                         return "gl.ALWAYS";

        /* StencilOp */
        /*      ZERO */
        case gl.KEEP:                                           return "gl.KEEP";
        case gl.REPLACE:                                        return "gl.REPLACE";
        case gl.INCR:                                           return "gl.INCR";
        case gl.DECR:                                           return "gl.DECR";
        case gl.INVERT:                                         return "gl.INVERT";
        case gl.INCR_WRAP:                                      return "gl.INCR_WRAP";
        case gl.DECR_WRAP:                                      return "gl.DECR_WRAP";

        /* StringName */
        case gl.VENDOR:                                         return "gl.VENDOR";
        case gl.RENDERER:                                       return "gl.RENDERER";
        case gl.VERSION:                                        return "gl.VERSION";

        /* TextureMagFilter */
        case gl.NEAREST:                                        return "gl.NEAREST";
        case gl.LINEAR:                                         return "gl.LINEAR";
    
        /* TextureMinFilter */
        /*      NEAREST */
        /*      LINEAR */
        case gl.NEAREST_MIPMAP_NEAREST:                         return "gl.NEAREST_MIPMAP_NEAREST";
        case gl.LINEAR_MIPMAP_NEAREST:                          return "gl.LINEAR_MIPMAP_NEAREST";
        case gl.NEAREST_MIPMAP_LINEAR:                          return "gl.NEAREST_MIPMAP_LINEAR";
        case gl.LINEAR_MIPMAP_LINEAR:                           return "gl.LINEAR_MIPMAP_LINEAR";

        /* TextureParameterName */
        case gl.TEXTURE_MAG_FILTER:                             return "gl.TEXTURE_MAG_FILTER";
        case gl.TEXTURE_MIN_FILTER:                             return "gl.TEXTURE_MIN_FILTER";
        case gl.TEXTURE_WRAP_S:                                 return "gl.TEXTURE_WRAP_S";
        case gl.TEXTURE_WRAP_T:                                 return "gl.TEXTURE_WRAP_T";

        /* TextureTarget */
        case gl.TEXTURE_2D:                                     return "gl.TEXTURE_2D";
        case gl.TEXTURE:                                        return "gl.TEXTURE";

        case gl.TEXTURE_CUBE_MAP:                               return "gl.TEXTURE_CUBE_MAP";
        case gl.TEXTURE_BINDING_CUBE_MAP:                       return "gl.TEXTURE_BINDING_CUBE_MAP";
        case gl.TEXTURE_CUBE_MAP_POSITIVE_X:                    return "gl.TEXTURE_CUBE_MAP_POSITIVE_X";
        case gl.TEXTURE_CUBE_MAP_NEGATIVE_X:                    return "gl.TEXTURE_CUBE_MAP_NEGATIVE_X";
        case gl.TEXTURE_CUBE_MAP_POSITIVE_Y:                    return "gl.TEXTURE_CUBE_MAP_POSITIVE_Y";
        case gl.TEXTURE_CUBE_MAP_NEGATIVE_Y:                    return "gl.TEXTURE_CUBE_MAP_NEGATIVE_Y";
        case gl.TEXTURE_CUBE_MAP_POSITIVE_Z:                    return "gl.TEXTURE_CUBE_MAP_POSITIVE_Z";
        case gl.TEXTURE_CUBE_MAP_NEGATIVE_Z:                    return "gl.TEXTURE_CUBE_MAP_NEGATIVE_Z";
        case gl.MAX_CUBE_MAP_TEXTURE_SIZE:                      return "gl.MAX_CUBE_MAP_TEXTURE_SIZE";

        /* TextureUnit */
        case gl.TEXTURE0:                                       return "gl.TEXTURE0";
        case gl.TEXTURE1:                                       return "gl.TEXTURE1";
        case gl.TEXTURE2:                                       return "gl.TEXTURE2";
        case gl.TEXTURE3:                                       return "gl.TEXTURE3";
        case gl.TEXTURE4:                                       return "gl.TEXTURE4";
        case gl.TEXTURE5:                                       return "gl.TEXTURE5";
        case gl.TEXTURE6:                                       return "gl.TEXTURE6";
        case gl.TEXTURE7:                                       return "gl.TEXTURE7";
        case gl.TEXTURE8:                                       return "gl.TEXTURE8";
        case gl.TEXTURE9:                                       return "gl.TEXTURE9";
        case gl.TEXTURE10:                                      return "gl.TEXTURE10";
        case gl.TEXTURE11:                                      return "gl.TEXTURE11";
        case gl.TEXTURE12:                                      return "gl.TEXTURE12";
        case gl.TEXTURE13:                                      return "gl.TEXTURE13";
        case gl.TEXTURE14:                                      return "gl.TEXTURE14";
        case gl.TEXTURE15:                                      return "gl.TEXTURE15";
        case gl.TEXTURE16:                                      return "gl.TEXTURE16";
        case gl.TEXTURE17:                                      return "gl.TEXTURE17";
        case gl.TEXTURE18:                                      return "gl.TEXTURE18";
        case gl.TEXTURE19:                                      return "gl.TEXTURE19";
        case gl.TEXTURE20:                                      return "gl.TEXTURE20";
        case gl.TEXTURE21:                                      return "gl.TEXTURE21";
        case gl.TEXTURE22:                                      return "gl.TEXTURE22";
        case gl.TEXTURE23:                                      return "gl.TEXTURE23";
        case gl.TEXTURE24:                                      return "gl.TEXTURE24";
        case gl.TEXTURE25:                                      return "gl.TEXTURE25";
        case gl.TEXTURE26:                                      return "gl.TEXTURE26";
        case gl.TEXTURE27:                                      return "gl.TEXTURE27";
        case gl.TEXTURE28:                                      return "gl.TEXTURE28";
        case gl.TEXTURE29:                                      return "gl.TEXTURE29";
        case gl.TEXTURE30:                                      return "gl.TEXTURE30";
        case gl.TEXTURE31:                                      return "gl.TEXTURE31";
        case gl.ACTIVE_TEXTURE:                                 return "gl.ACTIVE_TEXTURE";

        /* TextureWrapMode */
        case gl.REPEAT:                                         return "gl.REPEAT";
        case gl.CLAMP_TO_EDGE:                                  return "gl.CLAMP_TO_EDGE";
        case gl.MIRRORED_REPEAT:                                return "gl.MIRRORED_REPEAT";

        /* Uniform Types */
        case gl.FLOAT_VEC2:                                     return "gl.FLOAT_VEC2";
        case gl.FLOAT_VEC3:                                     return "gl.FLOAT_VEC3";
        case gl.FLOAT_VEC4:                                     return "gl.FLOAT_VEC4";
        case gl.INT_VEC2:                                       return "gl.INT_VEC2";
        case gl.INT_VEC3:                                       return "gl.INT_VEC3";
        case gl.INT_VEC4:                                       return "gl.INT_VEC4";
        case gl.BOOL:                                           return "gl.BOOL";
        case gl.BOOL_VEC2:                                      return "gl.BOOL_VEC2";
        case gl.BOOL_VEC3:                                      return "gl.BOOL_VEC3";
        case gl.BOOL_VEC4:                                      return "gl.BOOL_VEC4";
        case gl.FLOAT_MAT2:                                     return "gl.FLOAT_MAT2";
        case gl.FLOAT_MAT3:                                     return "gl.FLOAT_MAT3";
        case gl.FLOAT_MAT4:                                     return "gl.FLOAT_MAT4";
        case gl.SAMPLER_2D:                                     return "gl.SAMPLER_2D";
        case gl.SAMPLER_CUBE:                                   return "gl.SAMPLER_CUBE";

        /* Vertex Arrays */
        case gl.VERTEX_ATTRIB_ARRAY_ENABLED:                    return "gl.VERTEX_ATTRIB_ARRAY_ENABLED";
        case gl.VERTEX_ATTRIB_ARRAY_SIZE:                       return "gl.VERTEX_ATTRIB_ARRAY_SIZE";
        case gl.VERTEX_ATTRIB_ARRAY_STRIDE:                     return "gl.VERTEX_ATTRIB_ARRAY_STRIDE";
        case gl.VERTEX_ATTRIB_ARRAY_TYPE:                       return "gl.VERTEX_ATTRIB_ARRAY_TYPE";
        case gl.VERTEX_ATTRIB_ARRAY_NORMALIZED:                 return "gl.VERTEX_ATTRIB_ARRAY_NORMALIZED";
        case gl.VERTEX_ATTRIB_ARRAY_POINTER:                    return "gl.VERTEX_ATTRIB_ARRAY_POINTER";
        case gl.VERTEX_ATTRIB_ARRAY_BUFFER_BINDING:             return "gl.VERTEX_ATTRIB_ARRAY_BUFFER_BINDING";

        /* Shader Source */    
        case gl.COMPILE_STATUS:                                 return "gl.COMPILE_STATUS";

        /* Shader Precision-Specified Types */
        case gl.LOW_FLOAT:                                      return "gl.LOW_FLOAT";
        case gl.MEDIUM_FLOAT:                                   return "gl.MEDIUM_FLOAT";
        case gl.HIGH_FLOAT:                                     return "gl.HIGH_FLOAT";
        case gl.LOW_INT:                                        return "gl.LOW_INT";
        case gl.MEDIUM_INT:                                     return "gl.MEDIUM_INT";
        case gl.HIGH_INT:                                       return "gl.HIGH_INT";

        /* Framebuffer Object. */
        case gl.FRAMEBUFFER:                                    return "gl.FRAMEBUFFER";
        case gl.RENDERBUFFER:                                   return "gl.RENDERBUFFER";

        case gl.RGBA4:                                          return "gl.RGBA4";
        case gl.RGB5_A1:                                        return "gl.RGB5_A1";
        case gl.RGB565:                                         return "gl.RGB565";
        case gl.DEPTH_COMPONENT16:                              return "gl.DEPTH_COMPONENT16";
        case gl.STENCIL_INDEX:                                  return "gl.STENCIL_INDEX";
        case gl.STENCIL_INDEX8:                                 return "gl.STENCIL_INDEX8";
        case gl.DEPTH_STENCIL:                                  return "gl.DEPTH_STENCIL";

        case gl.RENDERBUFFER_WIDTH:                             return "gl.RENDERBUFFER_WIDTH";
        case gl.RENDERBUFFER_HEIGHT:                            return "gl.RENDERBUFFER_HEIGHT";
        case gl.RENDERBUFFER_INTERNAL_FORMAT:                   return "gl.RENDERBUFFER_INTERNAL_FORMAT";
        case gl.RENDERBUFFER_RED_SIZE:                          return "gl.RENDERBUFFER_RED_SIZE";
        case gl.RENDERBUFFER_GREEN_SIZE:                        return "gl.RENDERBUFFER_GREEN_SIZE";
        case gl.RENDERBUFFER_BLUE_SIZE:                         return "gl.RENDERBUFFER_BLUE_SIZE";
        case gl.RENDERBUFFER_ALPHA_SIZE:                        return "gl.RENDERBUFFER_ALPHA_SIZE";
        case gl.RENDERBUFFER_DEPTH_SIZE:                        return "gl.RENDERBUFFER_DEPTH_SIZE";
        case gl.RENDERBUFFER_STENCIL_SIZE:                      return "gl.RENDERBUFFER_STENCIL_SIZE";

        case gl.FRAMEBUFFER_ATTACHMENT_OBJECT_TYPE:             return "gl.FRAMEBUFFER_ATTACHMENT_OBJECT_TYPE";
        case gl.FRAMEBUFFER_ATTACHMENT_OBJECT_NAME:             return "gl.FRAMEBUFFER_ATTACHMENT_OBJECT_NAME";
        case gl.FRAMEBUFFER_ATTACHMENT_TEXTURE_LEVEL:           return "gl.FRAMEBUFFER_ATTACHMENT_TEXTURE_LEVEL";
        case gl.FRAMEBUFFER_ATTACHMENT_TEXTURE_CUBE_MAP_FACE:   return "gl.FRAMEBUFFER_ATTACHMENT_TEXTURE_CUBE_MAP_FACE";

        case gl.COLOR_ATTACHMENT0:                              return "gl.COLOR_ATTACHMENT0";
        case gl.DEPTH_ATTACHMENT:                               return "gl.DEPTH_ATTACHMENT";
        case gl.STENCIL_ATTACHMENT:                             return "gl.STENCIL_ATTACHMENT";
        case gl.DEPTH_STENCIL_ATTACHMENT:                       return "gl.DEPTH_STENCIL_ATTACHMENT";

        case gl.NONE:                                           return "gl.NONE";

        case gl.FRAMEBUFFER_COMPLETE:                           return "gl.FRAMEBUFFER_COMPLETE";
        case gl.FRAMEBUFFER_INCOMPLETE_ATTACHMENT:              return "gl.FRAMEBUFFER_INCOMPLETE_ATTACHMENT";
        case gl.FRAMEBUFFER_INCOMPLETE_MISSING_ATTACHMENT:      return "gl.FRAMEBUFFER_INCOMPLETE_MISSING_ATTACHMENT";
        case gl.FRAMEBUFFER_INCOMPLETE_DIMENSIONS:              return "gl.FRAMEBUFFER_INCOMPLETE_DIMENSIONS";
        case gl.FRAMEBUFFER_UNSUPPORTED:                        return "gl.FRAMEBUFFER_UNSUPPORTED";

        case gl.FRAMEBUFFER_BINDING:                            return "gl.FRAMEBUFFER_BINDING";
        case gl.RENDERBUFFER_BINDING:                           return "gl.RENDERBUFFER_BINDING";
        case gl.MAX_RENDERBUFFER_SIZE:                          return "gl.MAX_RENDERBUFFER_SIZE";

        case gl.INVALID_FRAMEBUFFER_OPERATION:                  return "gl.INVALID_FRAMEBUFFER_OPERATION";

        /* WebGL-specific enums */
        case gl.UNPACK_FLIP_Y_WEBGL:                            return "gl.UNPACK_FLIP_Y_WEBGL";
        case gl.UNPACK_PREMULTIPLY_ALPHA_WEBGL:                 return "gl.UNPACK_PREMULTIPLY_ALPHA_WEBGL";
        case gl.CONTEXT_LOST_WEBGL:                             return "gl.CONTEXT_LOST_WEBGL";
        case gl.UNPACK_COLORSPACE_CONVERSION_WEBGL:             return "gl.UNPACK_COLORSPACE_CONVERSION_WEBGL";
        case gl.BROWSER_DEFAULT_WEBGL:                          return "gl.BROWSER_DEFAULT_WEBGL";
        default:                                                return "(" + which + ")";
    }
}