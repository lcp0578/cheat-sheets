## OpenSpec：Spec-driven development (SDD) for AI coding assistants 规范先行

- [github.com/Fission-AI/OpenSpec](https://github.com/Fission-AI/OpenSpec)

- OpenSpec的核心思想是 **“规范先行”（Spec-Driven Development）** -。它要求在编写任何代码之前，先通过一套结构化的文档，将需求、设计和验收标准明确下来。

- 它的工作流程围绕四个核心命令展开：
	- 1. **`/opsx:propose` (提出变更)**：当你有一个新想法时，执行此命令，OpenSpec会自动生成一个包含以下文件的变更文件夹：
       - **`proposal.md`**：阐述“为什么”要做这个功能及其影响范围。
       - **`specs/`**：存放具体的功能需求规格，每条需求都附带 **验收场景（Scenario）** ，作为AI编码和测试的准绳。
       - **`design.md`**：记录技术方案、架构决策和潜在风险。
       - **`tasks.md`**：将工作拆解为可执行的、细粒度的任务清单。
	- 2. **人工审阅**：在AI动手前，开发者会审阅这些文档。在这个阶段修改想法，成本远比修改代码要低。
	- 3. **`/opsx:apply` (执行变更)**：审阅通过后，AI会严格按照`tasks.md`中的清单逐步执行。即使任务中断，下次执行时也能从中断处继续，解决了AI“失忆”的问题。
	- 4. **`/opsx:archive` (归档变更)**：功能完成后，执行此命令将本次变更的规范合并到主规范中，完成一个完整的开发闭环。

- 此外，OpenSpec还提供了 **`/opsx:explore` (探索模式)** 命令，让AI能够先分析理解现有代码库（尤其是历史遗留模块），再基于此生成贴合实际架构的设计方案