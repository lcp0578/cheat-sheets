## AI Agents简介

> https://github.com/microsoft/ai-agents-for-beginners/

- What are AI Agents?
	- AI Agents are systems that enable Large Language Models(LLMs) to perform actions by extending their capabilities by giving LLMs access to tools and knowledge.
- The different types of agents
	<table>
		<tr>
			<th>Agent Type</th>
			<th>Description</th>
			<th>Example</th>
		</tr>
		<tr>
			<td>Simple Reflex Agents</td>	
			<td>Perform immediate actions based on predefined rules.</td>
			<td>Travel agent interprets the context of the email and forwards travel complaints to customer service.</td>
		</tr>
		<tr>
			<td>Model-Based Reflex Agents</td>
			<td>Perform actions based on a model of the world and changes to that model.</td>	
			<td>Travel agent prioritizes routes with significant price changes based on access to historical pricing data.</td>
		</tr>
		<tr>
			<td>Goal-Based Agents</td>	
			<td>Create plans to achieve specific goals by interpreting the goal and determining actions to reach it.</td>	
			<td>Travel agent books a journey by determining necessary travel arrangements (car, public transit, flights) from the current location to the destination.</td>
		</tr>
		<tr>
			<td>Utility-Based Agents</td>	
			<td>Consider preferences and weigh tradeoffs numerically to determine how to achieve goals.</td>	
			<td>Travel agent maximizes utility by weighing convenience vs. cost when booking travel.</td>
		</tr>
		<tr>
			<td>Learning Agents</td>	
			<td>Improve over time by responding to feedback and adjusting actions accordingly.</td>	
			<td>Travel agent improves by using customer feedback from post-trip surveys to make adjustments to future bookings.</td>
		</tr>
		<tr>
			<td>Hierarchical Agents</td>	
			<td>Feature multiple agents in a tiered system, with higher-level agents breaking tasks into subtasks for lower-level agents to complete.</td>	
			<td>Travel agent cancels a trip by dividing the task into subtasks (for example, canceling specific bookings) and having lower-level agents complete them, reporting back to the higher-level agent.</td>
		</tr>
		<tr>
			<td>Multi-Agent Systems (MAS)</td>	
			<td>Agents complete tasks independently, either cooperatively or competitively.</td>	
			<td>Cooperative: Multiple agents book specific travel services such as hotels, flights, and entertainment. Competitive: Multiple agents manage and compete over a shared hotel booking calendar to book customers into the hotel.</td>
	</table>