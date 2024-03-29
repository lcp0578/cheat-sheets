## Listeners or Subscribers
- Listeners and subscribers can be used in the same application indistinctly. The decision to use either of them is usually a matter of personal taste. However, there are some minor advantages for each of them:

	- **Subscribers are easier to reuse** because the knowledge of the events is kept in the class rather than in the service definition. This is the reason why Symfony uses subscribers internally;
	- **Listeners are more flexible** because bundles can enable or disable each of them conditionally depending on some configuration value.
- To avoid having a configuration file that describes which events a listener wants to listen to, create a subscriber. 
- A subscriber is a listener with a static `getSubscribedEvents()` method that returns its configuration. This allows subscribers to be registered in the Symfony dispatcher automatically.