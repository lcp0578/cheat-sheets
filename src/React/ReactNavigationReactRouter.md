## React Navigation vs React Router
- https://reactnavigation.org/
- https://reactrouter.com/
#### React Navigation vs React Router: What are the differences?
- React Navigation and React Router are two popular routing libraries in the React ecosystem. While they both enable navigation in a React application, there are several key differences between the two:
	- **Routing Paradigm**: React Navigation is primarily designed for mobile applications and provides a stack-based navigation model similar to native mobile app navigation. It allows for easy navigation between screens using gestures like swipe, and provides built-in support for tab navigation and drawer navigation. On the other hand, React Router is designed for web applications and follows a traditional hierarchical routing paradigm. It uses a declarative approach to define routes and renders components based on the current URL path.
	- **API and Configuration**: React Navigation provides a more simplified and intuitive API for configuring navigation. It uses a declarative approach where navigation is defined using components and props. React Router, on the other hand, provides a more flexible and powerful API that allows for fine-grained control over routing. It uses a functional approach where routes are defined using plain JavaScript objects.
	- **Platform Compatibility**: React Navigation is cross-platform and supports both iOS and Android applications. It provides a consistent navigation experience across different platforms. React Router is primarily focused on web applications and may not have built-in support for specific mobile features or gestures.
	- **Community and Ecosystem**: React Navigation has a large and active community with extensive documentation and community-contributed libraries and plugins. It has been widely adopted in the React Native ecosystem and has a rich ecosystem of third-party extensions. React Router also has a strong community and ecosystem, but it is more focused on web applications and may have fewer resources specific to React Native development.
	- **Integration with React Libraries**: React Navigation integrates well with other React Native libraries and frameworks such as Redux and MobX for state management. It provides built-in support for managing navigation state using these libraries. React Router, on the other hand, integrates well with other React web libraries and frameworks such as Redux and GraphQL.
	- **Component Styling**: React Navigation provides a built-in way to style navigation components using its own styling system. It allows for easy customization of navigation bars, tab bars, and other navigation UI elements. React Router, being primarily focused on web applications, provides more flexibility in terms of component styling. It can be easily styled using CSS or CSS-in-JS libraries like styled-components.
- In summary, choose React Navigation for mobile-specific gestures, simple configuration, and a native-like experience. Opt for React Router if you need web-focused routing, a flexible API, and deeper integration with web libraries. Both offer robust navigation solutions, tailored to different platform priorities.