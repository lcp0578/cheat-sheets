## Command Lifecycle
- Commands have three lifecycle methods that are invoked when running the command:
	- `initialize()` **(optional)**
		- This method is executed before the `interact()` and the `execute()` methods. Its main purpose is to initialize variables used in the rest of the command methods.
	- `interact()` **(optional)**
		- This method is executed after `initialize()` and before `execute()`. Its purpose is to check if some of the options/arguments are missing and interactively ask the user for those values. This is the last place where you can ask for missing required options/arguments. This method is called before validating the input. Note that it will not be called when the command is run without interaction (e.g. when passing the `--no-interaction` global option flag).
	- `execute()` **(required)**
		- This method is executed after `interact()` and `initialize()`. It contains the logic you want the command to execute and it must return an integer which will be used as the command exit status.