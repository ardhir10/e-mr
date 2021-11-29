USE [DB_SOLVUS]
GO

/****** Object:  Table [dbo].[TAR_MODEL_HAS_ROLES]    Script Date: 11/30/2021 3:05:50 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TAR_MODEL_HAS_ROLES](
	[role_id] [bigint] NOT NULL,
	[model_type] [nvarchar](255) NOT NULL,
	[model_id] [bigint] NOT NULL,
 CONSTRAINT [model_has_roles_role_model_type_primary] PRIMARY KEY CLUSTERED 
(
	[role_id] ASC,
	[model_id] ASC,
	[model_type] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[TAR_MODEL_HAS_ROLES]  WITH CHECK ADD  CONSTRAINT [model_has_roles_role_id_foreign] FOREIGN KEY([role_id])
REFERENCES [dbo].[TAR_ROLES] ([id])
ON DELETE CASCADE
GO

ALTER TABLE [dbo].[TAR_MODEL_HAS_ROLES] CHECK CONSTRAINT [model_has_roles_role_id_foreign]
GO


