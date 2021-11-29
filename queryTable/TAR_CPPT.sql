USE [DB_SOLVUS]
GO

/****** Object:  Table [dbo].[TAR_CPPT]    Script Date: 11/30/2021 2:59:25 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TAR_CPPT](
	[FN_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[FD_DATE] [nvarchar](255) NULL,
	[FS_MR] [nvarchar](255) NULL,
	[FT_SUBJECTIVE] [nvarchar](max) NULL,
	[FT_OBJECTIVE] [nvarchar](max) NULL,
	[FT_ASSESMENT] [nvarchar](max) NULL,
	[FS_KD_LAYANAN] [nvarchar](255) NULL,
	[FS_PROFESI] [nvarchar](255) NULL,
	[FS_PLAN1] [nvarchar](255) NULL,
	[FS_PLAN2] [nvarchar](255) NULL,
	[FS_PLAN3] [nvarchar](255) NULL,
	[FS_PLAN4] [nvarchar](255) NULL,
	[FS_IPPA1A] [nvarchar](255) NULL,
	[FS_IPPA1B] [nvarchar](255) NULL,
	[FS_IPPA2A] [nvarchar](255) NULL,
	[FS_IPPA2B] [nvarchar](255) NULL,
	[FS_IPPA3A] [nvarchar](255) NULL,
	[FS_IPPA3B] [nvarchar](255) NULL,
	[FS_IPPA3C] [nvarchar](255) NULL,
	[FS_USER] [nvarchar](255) NULL,
	[FS_DPJP] [nvarchar](255) NULL,
	[FS_VERIFIED_BY] [nvarchar](255) NULL,
	[FS_REGISTER] [nvarchar](255) NULL,
	[FS_KD_PEG] [nvarchar](255) NULL,
	[FS_IPPA1C] [nvarchar](255) NULL,
	[FS_IPPA2C] [nvarchar](255) NULL,
	[FS_IPPA4A] [nvarchar](255) NULL,
	[FS_IPPA4B] [nvarchar](255) NULL,
	[FS_IPPA4C] [nvarchar](255) NULL,
	[FS_FROM] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[FN_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO


