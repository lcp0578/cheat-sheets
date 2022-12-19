## Vulkan和OpenGL区别
- Vulkan与OpenGL相比，可以更详细的向显卡描述你的应用程序打算做什么，从而可以获得更好的性能和更小的驱动开销。
- Vulkan的设计理念与Direct3D 12和Metal基本类似，
- Vulkan作为OpenGL的替代者，它设计之初就是为了跨平台实现的，可以同时在Windows、Linux和Android开发。甚至在Mac OS系统上，Khronos也提供了Vulkan的SDK，虽然这个SDK底层其实是使用MoltenVK实现的。
- Vulkan的最大任务不是竞争DirectX，而是取代OpenGL，所以重点要看和后者的对比。在高分辨率、高画质、需要GPU发挥的时候，Vulkan、OpenGL的速度基本差不多，但是随着分辨率的降低，CPU越来越重要，Vulkan逐渐体现了出来，尤其是看看GTX 980 Ti，最多可以领先OpenGL 33％之多！